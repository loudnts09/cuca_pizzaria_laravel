<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTeste extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Pizzaria do Cuca');
        });
    }

    public function testNavigationToOrdersPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Cadastre-se') 
                    ->assertPathIs('/cadastro')
                    ->assertSee('Cadastro de Novo Usuário');
        });
    }
}
