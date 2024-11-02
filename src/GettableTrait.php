<?php

namespace Julien\Budget;

trait GettableTrait {

    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->{$name};
        } elseif (method_exists($this, $name)) {
            return $this->{$name}();
        } else {
            throw new \Exception("No property named $name");
        }
    }

}