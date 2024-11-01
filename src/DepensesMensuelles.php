<?php

namespace Julien\Budget;

class DepensesMensuelles extends \ArrayObject {
    
    /**
     * So we can access keys without having an error if element doesn't exists
     */
    public function offsetGet($value): mixed {
        if (isset($this[$value])) {
            return parent::offsetGet($value);
        } else {
            // throw new \Exception('n');
            return new DepenseMensuelle(0, 0); // So it fails silently
        }
    }
}