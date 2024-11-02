<?php
use Julien\Budget\Depense;
use PHPUnit\Framework\TestCase;

class DepenseTest extends TestCase {
   

    public function testSubtraction() {
        $d = new Depense([
            "date" => new \DateTime('now'),
            "montant" => 10,
            "description" => "Description",
        ]);
        $this->assertEquals(10, $d->montant);
        
    }
}