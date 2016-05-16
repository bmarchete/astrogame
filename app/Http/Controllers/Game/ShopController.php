<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use App\UserBag;

class ShopController extends GameController
{
    
    

    public function buy_item(Request $request){
        $item_id = $request->id;
        $item_return = Item::buy_item($item_id);

        return response()->json($item_return);
    }

    public function remove_item(Request $request){
        $item_id = $request->id;
        $item_return = UserBag::remove_item_from_bag($item_id, 1);

        return response()->json(['status' => true, 'msg' => 'Item removido!']);
    }   
}
