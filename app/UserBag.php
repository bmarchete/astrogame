<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserBag extends Model
{
    public static function bag(){
    	$user_id = Auth::user()->id;
    	return UserBag::join('items', 'user_bags.item_id', '=', 'items.id')
    				->select('items.name', 'items.price', 'items.description', 'items.min_level', 'items.img_url', 'user_bags.amount')
    				->where('user_id', $user_id)
    				->limit(10)
    				->get();
    }

    public static function has_item($item_id){
    	$user_id = Auth::user()->id;
    	$check_item = UserBag::where('user_id', $user_id)
    						 ->select('id')
    						 ->where('item_id', $item_id)
    						 ->limit(1)
    						 ->get()
    						 ->first();
		return ($check_item) ? true : false;    						 
    }
}
