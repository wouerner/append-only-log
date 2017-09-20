<?php
require __DIR__ . '/vendor/autoload.php';

use Wouerner\Log as Log;
use Wouerner\Collection as Collection;
use Wouerner\Database as Database;

$chain = new Database();
$storage = new Collection();

$initLog = new Log();
$log2 = new Log();
$log3 = new Log();
$log4 = new Log();

/*Inicio projeto*/
$initData = new stdClass();
$initData->nome = 'Salic';

$initLog->id = '123';
$initLog->setData($initData);
$initLog->hash = $initLog->calculeHash();
/*Inicio projeto*/

$logData = new stdClass();
$logData->nome = 'Salic';
$logData->status = 'Aprovado';

$log2->id = '123';
$log2->prev_hash = $initLog->hash;
$log2->setData($logData);
$log2->hash = $log2->calculeHash();

$log3->id = '123';
$log3->prev_hash = $log2->hash;
$log3->hash = $log3->calculeHash();

//hack
/* $log3hack->id = '123'; */
/* $log3hack->prev_hash = $log2->hash . 'hack'; */
/* $log3hack->hash = $log3->calculeHash(); */

//hack
$log3hack = new Log();
//hack
$log3Data = new stdClass();
$log3Data->nome = 'Salic';
$log3Data->status = 'Reprovado'; // dado que não tinha no log original
//hack
$log3hack->id = '123';
$log3hack->prev_hash = $log2->hash;
$log3hack->setData($log3Data);
$log3hack->hash = $log3->calculeHash(); // hash bloco original

$log4->id = '123';
$log4->prev_hash = $log3->hash;
$log4->hash = $log4->calculeHash();

$storage->attach($initLog);
$storage->attach($log2);
$storage->attach($log3);
$storage->attach($log3hack);
$storage->attach($log4);

$genesis = $storage->genesis();

// dados originais
echo '<br>Dados Originais:';
$storage->showRaw();

echo '<br>Verificado';
$vStore2 = new Collection();
$storage->verify($genesis, $vStore2);

foreach ($vStore2 as $obj) {
    $chain->insert($obj->id, $obj->prev_hash, $obj->hash, $obj->data);
}

$vStore2->showRaw();
