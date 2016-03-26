<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProgres extends Model
{
    public $keys = 
    [
    	[
    		'name' => 'welcome',
    		'xp_reward' => 2000,
            'items_reward' => [],
    		'min_level' => 1,
    	],

    	[
    		'name' => 'tutorial',
    		'xp_reward' => 100,
    		'items_reward' => [1, 2],
    		'min_level' => 1,
    	],

    	[
    		'name' => 'chapter1',
    		'xp_reward' => 100,
    		'items_reward' => [1, 2],
    		'min_level' => 2,
    	],

    ];

    public function completed(){
    	// @TODO: checagem

    	$progress = $this->select('key')->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
    	return ($progress) ? true : false;
    }


    // @return string (capítulo atual, ou seja, o próximo a concluir)
    public function current(){
    	$all_chapters_completed = $this->select('key')->where('user_id', auth()->user()->id)->orderBy('updated_at', 'ASC')->get();
    	
    	if(empty($all_chapters_completed->first())){
    		return (object) $this->keys[0];
    	}

    	foreach($all_chapters_completed as $key){
    		$chapters_completed[$this->key] = $key->key;
    	}

    	foreach($this->keys as $this->key => $name){
    		$final_keys[] = $name['name'];
    	}

    	$chapters_completed = array_intersect($final_keys, $chapters_completed); // une os capítulos completados
    	$chapter_num = count($chapters_completed); // lembrete: lembre que a array começa sempre com 0 (não é necessário tirar -1 aqui)
    	return (object) $this->keys[$chapter_num];
    }

    public function complete(){
    	$key_data = [];
    	// search importante
    	foreach($this->keys as $key){
    		if($key['name'] == $this->key){
    			$key_data = $key; // acha todas as informações do capítulo
    		}
    	}

    	if(empty($key_data)){
    		return ['completed' => false, 'msg' => 'chapter nao existe'];
    	}

    	$check_chapter = $this->select('key')->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
    	if($check_chapter){
    		return ['completed' => false, 'msg' => 'chapter ja completado antes'];
    	}

    	$progress_table = $this->insert(['key' => $this->key, 'user_id' => auth()->user()->id]);
    	
    	// xp_reward
    	if(isset($key_data['xp_reward'])){
    		// User::xp_reward($key_data['xp_reward']);
    	}

    	// items_reward
    	if(isset($key_data['items'])){
    		foreach($key_data['items'] as $item => $item_id){
    			// UserBag::add_item($item_id);
    		}
    	}

    	return ['completed' => $progress_table, 'xp_reward' => $key_data['xp_reward'], 'items_reward' => $key_data['items_reward']];
    }

    // @TODO : FINISH HIM
    public function remove_chapter(){
    	$check_chapter = $this->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
    	if($check_chapter){
    		return $this->delete();
    	}
    }
}
