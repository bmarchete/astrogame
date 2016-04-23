<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserBag extends Model
{
    public static function bag(){
    	$user_id = auth()->user()->id;
    	return DB::table('user_bags')
                    ->join('items', 'user_bags.item_id', '=', 'items.id')
                    ->select(DB::raw("SUM(amount) as 'amount', items.id, items.name, items.price, items.description, items.min_level, items.img_url, items.max_stack"))
    				->where('user_id', $user_id)
                    ->groupBy('item_id')
    				->limit(10)
    				->get();
    }

    public static function has_item($item_id){
    	$user_id = auth()->user()->id;
    	$check_item = UserBag::where('user_id', $user_id)
    						 ->select('id')
    						 ->where('item_id', $item_id)
    						 ->limit(1)
    						 ->get()
    						 ->first();
		return ($check_item) ? true : false;    						 
    }

    public static function user_has_item_amount($item_id){
        $user_id = auth()->user()->id;
        $bag_item = UserBag::select(DB::raw("SUM(amount) as 'amount'"))
                    ->where('user_id', $user_id)
                    ->where('item_id', $item_id)
                    ->groupBy('item_id')
                    ->limit(1)
                    ->get()->first();
        if($bag_item){
            return $bag_item->amount;
        } else {
            return 0;
        }
    }

    public static function remove_item_from_bag($item_id, $amount){
        $user_id = auth()->user()->id;
        
        if(UserBag::user_has_item_amount($item_id) == $amount){ // remove todos os items
            return DB::table('user_bags')->where('item_id', $item_id)->where('user_id', $user_id)->delete();
        }

        DB::table('user_bags')->where('user_id', $user_id)->where('item_id', $item_id)->decrement('amount', $amount);
    }
}
