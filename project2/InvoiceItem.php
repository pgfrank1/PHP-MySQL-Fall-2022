<?php

class InvoiceItem
{
    private $itemId;
    private $itemQuantity;
    private $itemPrice;
    private $itemDescription;

    public function __construct($itemId)
    {
        $this->__set('itemId', $itemId);
    }

    public function __get($ivar)
    {
        return $this->$ivar;
    }
    public function __set($ivar, $value)
    {
        $this->$ivar = $value;
    }

    public function calculateItemTotal()
    {
        return $this->itemQuantity * $this->itemPrice;
    }

    public function display()
    {
        return "Item ID : " . $this->__get('itemId') . ", Item Quantity: "
            . $this->__get('itemQuantity') . ", Item Price: $" . $this->__get('itemPrice')
            . ", Item Description: " . $this->__get('itemDescription') . ", Item Total Cost: $"
            . $this->calculateItemTotal();
    }
}