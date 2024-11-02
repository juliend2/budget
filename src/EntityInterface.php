<?php

namespace Julien\Budget;

interface EntityInterface {
    public function __construct($options);
    public function __get(string $name);
}