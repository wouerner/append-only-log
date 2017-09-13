<?php
namespace Wouerner;

require_once(__DIR__ . '/Log.php');

use Wouerner\Log as Log;

class Collection extends \SplObjectStorage
{
    function showRaw()
    {
        if (!empty($this)){
            foreach ($this as $obj) {
                var_dump($obj);
            }
        } else {
            echo 'vazio';
        }
    }

    function genesis()
    {
        foreach ($this as $obj) {
            if (is_null($obj->prev_hash)) {
                return $obj;
            }
        }
    }

    function findChain($hash)
    {
        foreach ($this as $obj) {
            if ($obj->hash == $hash) {
                return $obj;
            }
        }
        return 0;
    }

    // busca o proximo registro
    function nextChain($hash)
    {
        foreach ($this as $obj) {
            if (!is_null($obj->prev_hash) && $obj->prev_hash == $hash) {
                return $obj;
            }
        }
    }

    // com o hash inicial percorre os proximos elementos
    function orderChain($genesis, &$storageNew)
    {
        $next = nextChain($genesis->hash);
        if ($next) {
            $storageNew->attach($next);
            orderChain($next, $storageNew);
        }
        return $storageNew;
    }

    public function verify($genesis, &$verifiedStore)
    {
        $verifiedStore->attach($genesis);

        $next = $this->nextChain($genesis->hash);

        //2 log
        $log = new Log();
        $log->id = $genesis->id;
        $log->prev_hash = $genesis->hash;
        $log->status = $next->status;
        $log->hash = $log->calculeHash();

        $chain = $this->findChain($log->hash);

        if (!$chain) {
            return 0;
        }

        if ($chain->hash == $log->hash) {
            $this->verify($chain, $verifiedStore);
        } else {
            echo '<br>error';
        }
        return $verifiedStore;
    }
} 
