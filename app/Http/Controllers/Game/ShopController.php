<?php

namespace App\Http\Controllers;

use App\Item;
use App\UserBag;
use App\History;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ShopController extends GameController
{
    public function buy_item(ItemRequest $request)
    {
        $item_id = $request->id;

        $user = auth()->user();
        $item = Item::select('id', 'name', 'price', 'min_level', 'max_stack', 'img_url')->where('id', $item_id)->limit(1)->get()->first();

        if ($item->min_level > $user->level) {
            return ['status_or_price' => false, 'msg' => 'Não é possível comprar esse item devido ao seu level'];
        }

        if ($user->money <= $item->price) {
            return ['status_or_price' => false, 'msg' => 'Não é possível comprar esse item, pois não há dinheiro suficiente'];
        }

        if (UserBag::user_has_item_amount($item->id) >= $item->max_stack) {
            return ['status_or_price' => false, 'msg' => 'Você não pode carregar mais desse item'];
        }

        $user->decrement('money', $item->price);
        $user->save();

        $item_on_bag = UserBag::where('user_id', $user->id)->where('item_id', $item->id)->limit(1)->first();
        if ($item_on_bag) {
            // aumenta a quantidade de items
            UserBag::where('user_id', $user->id)->where('item_id', $item->id)->increment('amount', 1);
        } else {
            // insere um novo registro
            UserBag::insert(['user_id' => $user->id, 'item_id' => $item->id]);
        }

        $this->history_item($user, $item);

        $item_return = ['status_or_price' => $item->price, 'msg' => $item->name.' comprado',
            'item' => $item,
            // checar se já tem esse item, evitar apenas mudança de quantidade
            // @TODO tranformar esse HTML em json.
            'html' => '<li onclick="remove_item('.$item->id.')" class="item-'.$item->id.'"><span class="uk-badge uk-badge-success">1</span><figure class="uk-thumbnail" data-uk-tooltip title="'.$item->name.'"><img src="'.url('/img/items').'/'.$item->img_url.'.png" alt="" data-uk-tooltip=""></figure></li>',
          ];

        return response()->json($item_return);
    }

    public function remove_item(ItemRequest $request)
    {
        $item_id = $request->id;
        $item_return = UserBag::remove_item_from_bag($item_id, 1);

        return response()->json(['status' => true, 'msg' => 'Item removido!']);
    }

    public function history_item($user, Item $item)
    {
        $history = new History();
        $history->user_id = $user->id;
        $history->texto = 'Comprou o <strong>'.$item->name.'</strong> por '.$item->price.'';
        $history->icon = 'shopping-cart';
        $history->save();
    }
}
