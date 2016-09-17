<?php

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsSeeder extends Seeder
{
    //
    // categories:
    // 1 - misc
    // 2 - telescopio
    // 3 - livros
    // 4 - ??
    //
    public $items = [

        [
            'id'          => 1,
            'category'    => 2,
            'name'        => 'Tubo de telescópio',
            'description' => 'Tubo de metal ideial para amadores',
            'price'       => 300,
            'img_url'     => 'tubo-telescopico',
        ],

        [
            'id'          => 2,
            'category'    => 2,
            'name'        => 'Buscador',
            'description' => '',
            'price'       => 50,
            'img_url'     => 'buscador',
        ],

        [
            'id'          => 3,
            'category'    => 2,
            'name'        => 'Portaocular',
            'description' => '',
            'price'       => 100,
            'img_url'     => 'portaocular',
        ],

        [
            'id'          => 4,
            'category'    => 2,
            'name'        => 'Tripé',
            'description' => '',
            'price'       => 200,
            'img_url'     => 'tripe',
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::getQuery()->delete();

        foreach ($this->items as $item) {
            Item::insert($item);
            $this->command->info('Item: ' . e($item['name']) . " adicionado.");
        }
    }
}
