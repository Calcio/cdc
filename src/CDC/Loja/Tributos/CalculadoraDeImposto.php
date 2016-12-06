<?php

namespace CDC\Loja\Tributos;

use CDC\Loja\Tributos\Tabela;
use CDC\Loja\FluxoDeCaixa\Pedido;

class CalculadoraDeImposto
{
    protected $tabela;

    public function __construct(Tabela $tabela)
    {
        $this->tabela = $tabela;
    }

    public function calculaImposto(Pedido $pedido)
    {
        $taxa = $this->tabela->paraValor($pedido->getValorTotal());

        return $pedido->getValorTotal() * $taxa;
    }
}
