<?php
use Julien\Budget\DepenseMensuelle;
use PHPUnit\Framework\TestCase;

class DepenseMensuelleTest extends TestCase {
    public function testAddition() {
        $t = new DepenseMensuelle(10, 10);
        $this->assertTrue(true);
    }
}