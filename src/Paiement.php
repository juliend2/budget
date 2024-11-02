<?php

namespace Julien\Budget;

use Julien\Budget\GettableTrait;
use Julien\Budget\EntityInterface;

class Paiement implements EntityInterface
{
    use GettableTrait;

    protected float $montant;
    protected \DateTime $date;
    protected string $description;
    protected int $depense_id;

    public function __construct($options)
    {
        $this->date = $options['date'] ?? new \DateTime("now");
        $this->montant = $options['montant'] ?? 0;
        $this->description = $options['description'] ?? "";
        $this->depense_id = $options['depense_id'] or throw new \Exception("Missing depense_id");
    }
}
