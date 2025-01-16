<?php

require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

// URL do servidor Selenium
$serverUrl = 'http://localhost:4444/wd/hub';

// Inicializa o driver para o Chrome
$driver = RemoteWebDriver::create(
    $serverUrl,
    DesiredCapabilities::chrome()
);

// Acessa a página inicial
$driver->get('http://localhost');

// Espera até que o título da página seja 'Pizzaria do Cuca'
$wait = new WebDriverWait($driver, 10);
$wait->until(
    WebDriverExpectedCondition::titleIs('Pizzaria do Cuca')
);

// Verifica se o título da página está correto
if ($driver->getTitle() === 'Pizzaria do Cuca') {
    echo "Teste bem-sucedido!";
} else {
    echo "Teste falhou!";
}

// Fecha o navegador
$driver->quit();
