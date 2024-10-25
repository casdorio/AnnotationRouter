<?php

namespace Tests\AnnotationRouter;

use CodeIgniter\Test\CIUnitTestCase;
use Casdorio\AnnotationRouter\AnnotationProcessor;

class AnnotationProcessorTest extends CIUnitTestCase
{
    public function testProcessController()
    {
        // Crie um mock ou uma instância de um controlador com a anotação #[Controller]
        $processor = new AnnotationProcessor();
        
        // Chame o método que você deseja testar
        $result = $processor->processController(/* Passar o controlador mock aqui */);

        // Verifique o resultado esperado
        $this->assertTrue($result); // Substitua isso pela verificação real
    }

    // Adicione mais testes conforme necessário
}
