<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Contracts\Console\Kernel;

class LoginTeste extends DuskTestCase
{
    /**
     * Cria a aplicação para os testes.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Exemplo de teste básico.
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

    /**
     * Testa a navegação para a página de pedidos.
     *
     * @return void
     */
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
