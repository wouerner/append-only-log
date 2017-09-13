<?php
namespace Wouerner;

class Log
{
    public $id;
    public $prev_hash;
    public $hash;

    // Algoritmo de criação do Hash
    public function calculeHash()
    {
        return hash('sha256', $this->id . $this->nome . $this->status . $this->prev_hash);
    }

    public function __toString()
    {
        return  $this->hash;
    }
}
