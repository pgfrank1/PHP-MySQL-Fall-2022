<?php
require_once('InvoiceItem.php');

class Invoice
{
    private $invoiceItems = array();
    private $invoiceTotal;

    public function __get($ivar)
    {
        return $this->$ivar;
    }
    public function __set($ivar, $value)
    {
        $this->$ivar = $value;
    }

    public function getInvoiceItems()
    {
        return $this->invoiceItems;
    }

    public function setInvoiceItems($invoiceItem)
    {
        array_push($this->invoiceItems, $invoiceItem);
    }


    public function calculateInvoice()
    {
        $this->invoiceTotal = 0;

        foreach ($this->invoiceItems as $invoiceItem)
        {
            $this->invoiceTotal += $invoiceItem->calculateItemTotal();
        }
        return $this->invoiceTotal;
    }

    public function displayInvoice()
    {
        foreach ($this->invoiceItems as $invoiceItem)
        {
            echo $invoiceItem->display() . "<br>";
        }
        echo "Invoice Total: $" . $this->invoiceTotal;
    }
}