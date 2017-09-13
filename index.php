<?php
require_once(__DIR__ . '/Log.php');
require_once(__DIR__ . '/Collection.php');

use Wouerner\Log as Log;
use Wouerner\Collection as Collection;

$storage = new Collection();

$initLog = new Log();
$log2 = new Log();
$log3 = new Log();
$log4 = new Log();

/*Inicio projeto*/
$initLog->id = '123';
$initLog->nome = 'Salic';
$initLog->hash = $initLog->calculeHash();
/*Inicio projeto*/

$log2->id = '123';
$log2->prev_hash = $initLog->hash;
$log2->status = 'Aprovado';
$log2->hash = $log2->calculeHash();

$log3->id = '123';
$log3->prev_hash = $log2->hash;
$log3->hash = $log3->calculeHash();

$log4->id = '123';
$log4->prev_hash = $log3->hash;
$log4->hash = $log4->calculeHash();

$log4->id = '123';
$log4->prev_hash = $log3->hash;
$log4->hash = 'bugado';

//hack
$logHack = new Log();
$logHack->id = '1232';
$logHack->prev_hash = null;
$logHack->hash = $logHack->calculeHash();

//hack
$logHack2 = new Log();
$logHack2->id = '123';
$logHack2->prev_hash = $log3->hash;
$logHack2->hash = 2;

$storage->attach($initLog);
$storage->attach($log2);
$storage->attach($log4);
$storage->attach($log3);
//hack
$storage->attach($logHack);
$storage->attach($logHack2);

// dados originais
echo '<br>Dados Originais:';
$storage->showRaw();

$genesis = $storage->genesis();

echo '<br>Verificado';
$vStore = new Collection();
$storage->verify($genesis, $vStore);

$vStore->showRaw();



// dados originais
echo '<br>Dados Originais:';
$storage->showRaw();

$genesis = $storage->genesis();
$genesis->id = '1232';

echo '<br>Verificado';
$vStore2 = new Collection();
$storage->verify($genesis, $vStore2);

$vStore2->showRaw();
