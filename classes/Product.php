<?php

namespace Maharah\Classes;

use Exception;

class Product
{
    protected $name;
    protected $price;
    protected $quantity;

    public function __construct(string $name, int $quantity)
    {

        // If quantity is less than or equal to 0, throw an exception
        if ($quantity <= 0) {
            throw new Exception('Quantity must be greater than 0');
        }

        $parameters = [
            'name' => $name,
        ];
        $database = new Database();
        $record = $database->getRecord('SELECT * FROM `products` WHERE `name` = :name', $parameters);

        $this->name = $name;
        $this->price = $record['price'] ?? 0;
        $this->quantity = $quantity;
    }

    public function displayProductInfo()
    {
        return "Product: {$this->name} <br /> Price: {$this->price} LYD <br /> Quantity: {$this->quantity} <br />";
    }
}
