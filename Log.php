<?php
namespace Wouerner;

class Log
{
    public $id;
    public $prev_hash;
    public $hash;
    public $data;

    public function setData($data)
    {
        if (!is_null($data)) {
            $dataJSON = json_encode($data);
            $this->data = serialize($dataJSON);
            return;
        }

        $this->data = null;
    }

    public function getData()
    {
        if (!is_null($this->data)) {
            $data = unserialize($this->data);
            return json_decode($data);
        }
        return null;
    }

    public function getDataRaw()
    {
        $data = $this->getData();
        $dataJSON = json_encode($data);
        return $dataJSON;
    }

    // Algoritmo de criação do Hash
    public function calculeHash()
    {
        return hash('sha256', $this->id . $this->prev_hash . $this->getDataRaw());
    }

    public function __toString()
    {
        return  $this->hash;
    }
}
