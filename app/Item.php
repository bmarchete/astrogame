<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\UserBag;

class Item extends Model
{
    public $timestamps = false;

    public static function shop(){
    	return Item::all();
    }

    public static function buy_item($item_id){
    	$user = Auth::user();
    	$item = Item::select('id', 'name', 'price', 'min_level', 'max_stack', 'img_url')->where('id', $item_id)->limit(1)->get()->first();

    	if($item->min_level > $user->level){
    		return ['status_or_price' => false, 'msg' => 'Não é possível comprar esse item devido ao seu level'];
    	}

    	if($user->money <= $item->price){
    		return ['status_or_price' => false, 'msg' => 'Não é possível comprar esse item, pois não há dinheiro suficiente'];
    	}

    	if(UserBag::user_has_item_amount($item->id) >= $item->max_stack){
			return ['status_or_price' => false, 'msg' => 'Você não pode carregar mais desse item'];     		
    	}

    	DB::table('users')->where('id', $user->id)->decrement('money', $item->price);

    	$item_on_bag = UserBag::where('user_id', $user->id)
    						  ->where('item_id', $item->id)
    						  ->limit(1)
    						  ->get()
    						  ->first();

    	if($item_on_bag){ // aumenta a quantidade de items
    		DB::table('user_bags')->where('user_id', $user->id)->where('item_id', $item->id)->increment('amount', 1);
    	} else { // insere um novo registro
	    	UserBag::insert(['user_id' => $user->id, 'item_id' => $item->id]);
	    }

    	return ['status_or_price' => $item->price, 'msg' => $item->name . ' comprado',
    			// checar se já tem esse item, evitar apenas mudança de quantidade
    			'html' => '<li onclick="remove_item('. $item->id .')" class="item-'. $item->id .'"><span class="uk-badge uk-badge-success">1</span><figure class="uk-thumbnail" data-uk-tooltip title="'. $item->name .'"><img src="'. url('/img/items') . '/' . $item->img_url . '.png" alt="" data-uk-tooltip=""></figure></li>'];
    }

    public static function add_item($item_id){
        // @TODO: Finish HIM
    }
}
