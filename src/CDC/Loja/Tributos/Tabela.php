<?php

namespace CDC\Loja\Tributos;

use CDC\Loja\Tributos\TabelaInterface;

class Tabela implements TabelaInterface
{
    public function paraValor($valor)
    {
        return 200;
    }
}