<?php

namespace Maharah\Classes;

use Maharah\Interfaces\ProductInterface;
use Maharah\Traits\Logger;

class SamsungProduct extends Product implements ProductInterface
{
    use Logger;

    public function calculateTotalCost()
    {
        $total = $this->price * $this->quantity;

        $this->log("Total cost of {$this->name} is {$total} LYD");

        return $total;
    }
}
