<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;

use CDC\Exemplos\RelogioDoSistema;

use Mockery;

class SAPTest extends TestCase
{   
    public function testDeveEnviarNFGeradaParaSAP()
    {
        $dao = Mockery::mock("CDC\Loja\FluxoDeCaixa\NFDao");
        $dao->shouldReceive('persiste')->andReturn(true);

        $sap = Mockery::mock("CDC\Loja\FluxoDeCaixa\SAP");
        $sap->shouldReceive('envia')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($dao, $sap), new RelogioDoSistema());
        $pedido = new Pedido("Andre", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($sap->envia());
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.0001);
    }
}
