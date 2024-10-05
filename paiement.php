<?php

class Paiement {
    protected float $montant;

    public function __construct($montant) {
        $this->montant = $montant;
    }

    public function __get($name) {
        return $this->{$name};
    }
}
