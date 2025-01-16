<?php

namespace Tests;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Configura o navegador para usar o Selenium.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->startSeleniumServer();
    }

    /**
     * Inicia o servidor Selenium.
     *
     * @return void
     */
    protected function startSeleniumServer()
    {
        // Inicie o servidor Selenium aqui, se necessário.
    }

    /**
     * Configura as capacidades do navegador.
     *
     * @return DesiredCapabilities
     */
    protected function driver()
    {
        $capabilities = DesiredCapabilities::chrome();

        return RemoteWebDriver::create(
            'http://127.0.0.1:4444/wd/hub',
            $capabilities
        );
    }
}

