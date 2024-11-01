<?php
namespace Julien\Budget;

class Depense {
    protected float $montant;
    public function __construct($montant) {
        $this->montant = $montant;
    }
}