<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;

use CDC\Exemplos\RelogioDoSistema;

use Mockery;

class NFDaoTest extends TestCase
{
    public function testDevePersistirNFGerada()
    {
        $dao = Mockery::mock("CDC\Loja\FluxoDeCaixa\NFDao");
        $dao->shouldReceive('persiste')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($dao), new RelogioDoSistema());
        $pedido = new Pedido("Andre", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($dao->persiste());
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.0001);
    }
}
