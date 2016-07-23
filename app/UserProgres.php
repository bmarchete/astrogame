<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProgres extends Model
{
    public $keys =
        [
        [
            'name'         => 'welcome',
            'title'        => 'Boas Vindas',
            'xp_reward'    => 2000,
            'items_reward' => [],
            'min_level'    => 1,
        ],

        [
            'name'         => 'tutorial',
            'title'        => 'Tutorial',
            'xp_reward'    => 2500,
            'items_reward' => [],
            'min_level'    => 1,
            'insigna_reward' => 1,
        ],

        [
            'name'         => 'chapter1',
            'title'        => 'Capítulo 1',
            'xp_reward'    => 3000,
            'items_reward' => [],
            'min_level'    => 1,
        ],

        [
            'name'         => 'chapter2',
            'title'        => 'Capítulo 2',
            'xp_reward'    => 3000,
            'items_reward' => [],
            'min_level'    => 1,
        ],

    ];

    public function completed()
    {
        // @TODO: checagem

        $progress = $this->select('key')->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
        return ($progress) ? true : false;
    }

    // @return string (capítulo atual, ou seja, o próximo a concluir)
    public function current()
    {
        $all_chapters_completed = $this->select('key')->where('user_id', auth()->user()->id)->orderBy('updated_at', 'ASC')->get();

        if (empty($all_chapters_completed->first())) {
            return (object) $this->keys[0];
        }

        foreach ($all_chapters_completed as $key) {
            $chapters_completed[$this->key] = $key->key;
        }

        foreach ($this->keys as $this->key => $name) {
            $final_keys[] = $name['name'];
        }

        $chapters_completed = array_intersect($final_keys, $chapters_completed); // une os capítulos completados
        $chapter_num        = count($chapters_completed) + 1; // lembrete: lembre que a array começa sempre com 0 (não é necessário tirar -1 aqui)
        return (object) $this->keys[$chapter_num];
    }

    public function complete()
    {
        $key_data = [];
        // search importante
        foreach ($this->keys as $key) {
            if ($key['name'] == $this->key) {
                $key_data = $key; // acha todas as informações do capítulo
            }
        }

        if (empty($key_data)) {
            return (object) ['completed' => false, 'msg' => 'chapter nao existe'];
        }

        $check_chapter = $this->select('key')->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
        if ($check_chapter) {
            return (object) ['completed' => false, 'msg' => 'chapter ja completado antes'];
        }

        $progress_table = $this->insert(['key' => $this->key, 'user_id' => auth()->user()->id, 'completed' => true]);

        // xp_reward
        if (isset($key_data['xp_reward'])) {
            auth()->user()->gain_xp($key_data['xp_reward']);
        }

        // items_reward
        if (isset($key_data['items'])) {
            foreach ($key_data['items'] as $item_id) {
                // UserBag::add_item($item_id);
            }
        }

        // insigna_reward
        if(isset($key_data['insigna_reward'])) {
            if(is_array($key_data['insigna_reward'])){
                foreach ($key_data['insigna_reward'] as $insigna_id) {
                    //UserInsignas::add_insigna($insigna_id);
                }
            } else {
                //UserInsignas::add_insigna($key_data['insigna_reward']);
            }
        }

        $this->history_chapter(auth()->user(), $key_data['title']);

        return (object) ['completed' => $progress_table, 'xp_reward' => $key_data['xp_reward']];
    }

    // @TODO : FINISH HIM
    public function remove_chapter()
    {
        $check_chapter = $this->where('key', $this->key)->where('user_id', auth()->user()->id)->limit(1)->get()->first();
        if ($check_chapter) {
            return $this->delete();
        }
    }

    public function history_chapter(User $user, $chapter_name){
        $history = new \App\History;
        $history->user_id = $user->id;
        $history->texto = "Completou o capítulo <strong>" . $this->name . "</strong>";
        $history->icon = "space-shuttle";
        $history->save();
    }
}
