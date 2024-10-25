<?php

namespace Tests\AnnotationRouter;

use CodeIgniter\Test\CIUnitTestCase;
use Casdorio\AnnotationRouter\Hooks;

class HooksTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRegisterAnnotations()
    {
        $hooks = new Hooks();
        $hooks->registerAnnotations();

        $this->assertTrue(true); 
    }


}
