<?php

namespace AstroGame\Console\Commands;

use Illuminate\Console\Command;
use AstroGame\User;

class PlayerLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'astrogame:level {email} {level}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muda o level de um usuario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    // bugged
    public function handle()
    {
        $email = $this->argument('email');
        $level = $this->argument('level');

        $user = User::where('email', $email)->get()->first();

        $xp = 0;
        $array = [// level => xp_for_next_level 
        1 => 400,
        2 => 900,
        3 => 1400,
        4 => 2100,
        5 => 2800,
        6 => 3600,
        7 => 4500,
        8 => 5400,
        9 => 6500,
        10 => 7600,
        11 => 8700,
        12 => 9800,
        13 => 11000,
        14 => 12300,
        15 => 13600  ]; // isso não deve ficar aqui

        foreach($array as $array_level => $array_xp){
            if($array_level <= $level){
                $xp += $array_xp;
            }
        }
        
        if(!$user){
            return $this->error("[ERRO] $email nao esta associado com nenhuma conta");
        }

        $user->level = $level;
        $user->xp = $xp;
        $user->save();

        return $this->info("[INFO] Level do jogador alterado para $level");
    }
}
