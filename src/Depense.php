<?php
namespace Julien\Budget;

use Julien\Budget\GettableTrait;
use Julien\Budget\EntityInterface;

class Depense implements EntityInterface {
    use GettableTrait;

    protected \DateTime $date;
    protected float $montant;
    protected string $description;

    public function __construct($options) {
        $this->date = $options['date'] ?? new \DateTime("now");
        $this->montant = $options['montant'] ?? 0;
        $this->description = $options['description'] ?? "";
    }

}