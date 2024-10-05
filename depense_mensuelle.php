<?php

class DepenseMensuelle extends Depense {
    protected int $jour_du_mois;

    /**
     * @var Paiement[]
     */
    protected array $paiements = [];

    public function __construct($jour, $montant) {
        $this->jour_du_mois = $jour;
        parent::__construct($montant);
    }

    public function appliquer(Paiement $paiement) {
        $this->paiements[]= $paiement;
    }

    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->{$name};
        } elseif (method_exists($this, $name)) {
            return $this->{$name}();
        } else {
            throw new Exception("No property named $name");
        }
    }

    function restant() {
        return $this->montant - array_reduce(
            $this->paiements,
            fn($carry, $p) => $carry + $p->montant,
            0
        );
    }
}