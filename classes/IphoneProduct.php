<?php

namespace Maharah\Classes;

use Maharah\Interfaces\ProductInterface;
use Maharah\Traits\Logger;

class IphoneProduct extends Product implements ProductInterface
{
    use Logger;

    public function calculateTotalCost()
    {
        $price = $this->price + 100;
        $total = $price * $this->quantity;

        $this->log("Total cost of {$this->name} is {$total} LYD");

        return $total;
    }
}
