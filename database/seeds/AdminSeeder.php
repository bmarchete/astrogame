<?php

use Illuminate\Database\Seeder;
use AstroGame\User;
use AstroGame\Events\RegisterUser;

class AdminSeeder extends Seeder
{

	public $admins = [
		
		[
            'id' => 1,
            'name' => 'Eduardo Ramos',
            'email' => 'eduardo.ramos@hotmail.com.br',
            'nickname' => 'eduardo',
            'password' => '220499',
            'type' => 3,
            'gender' => 1,
            'level' => 1,
            'xp' => 100,
            'money' => 10000
        ],

        [
            'id' => 2,
            'name' => 'Adriano Faboci',
            'email' => 'adriano.faboci@hotmail.com.br',
            'nickname' => 'adriano',
            'password' => '220499',
            'type' => 3,
            'gender' => 1,
            'level' => 1,
            'xp' => 100,
            'money' => 10000
        ],

        [
            'id' => 3,
            'name' => 'Brenda Conttessotto',
            'email' => 'brenda.conte@hotmail.com.br',
            'nickname' => 'brenda',
            'password' => '220499',
            'type' => 3,
            'gender' => 1,
            'level' => 1,
            'xp' => 100,
            'money' => 10000
        ],

        [
            'id' => 4,
            'name' => 'Laís Vitória',
            'email' => 'lais.vitoria@hotmail.com.br',
            'nickname' => 'lais',
            'password' => '220499',
            'type' => 3,
            'gender' => 1,
            'level' => 1,
            'xp' => 100,
            'money' => 10000
        ],

        [
            'id' => 5,
            'name' => 'Gabriel Ferreira',
            'email' => 'gabriel.ferreira@hotmail.com.br',
            'nickname' => 'gabriel',
            'password' => '220499',
            'type' => 3,
            'gender' => 1,
            'level' => 1,
            'xp' => 100,
            'money' => 10000
        ],

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->admins as $admin){
    		if(DB::table('users')->where('email', $admin['email'])->get() == null){
                $user = new User;
                $user->id = $admin['id'];
                $user->name = $admin['name'];
                $user->email = $admin['email'];
                $user->nickname = $admin['nickname'];
                $user->password = bcrypt($admin['password']);
                $user->type = $admin['type'];
                $user->gender = $admin['gender'];
                $user->level = $admin['level'];
                $user->xp = $admin['xp'];
                $user->money = $admin['money'];
                $user->confirmed = true;
                
                $user->save();
                            
                event(new RegisterUser($user));
                echo '[ INFO ] Admin: ' . e($admin['email']) . " adicionado. \n";
    		}
    	}
    }
}
