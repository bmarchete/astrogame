<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
 
    public function testNewUserRegistration(){
    	$this->assertTrue(true);
    	
    	$this->visit('/register')
         ->type('Taylor', 'name')
         ->type('edu@edu.com', 'email')
         ->type('123', 'password')
         ->type('123', 'password_confirmation')
         ->press('Register')
         ->seePageIs('/dashboard');
    }

    public function testGainXp() { }
    public function testLevel() { }
    public function testLogin() { }
    public function testChangeProfile() { }
}
