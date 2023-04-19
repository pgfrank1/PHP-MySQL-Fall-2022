<?php
require_once('Invoice.php');

class ProcessInvoice
{
    private $invoice;

    private function createInvoiceItems()
    {
        $itemOne = new InvoiceItem(123);
        $itemTwo = new InvoiceItem(456);
        $itemThree = new InvoiceItem(789);

        $itemOne->itemDescription = 'magnets';
        $itemTwo->itemDescription = 'tires';
        $itemThree->itemDescription = 'whistles';

        $itemOne->itemPrice = 4.99;
        $itemTwo->itemPrice = 45.99;
        $itemThree->itemPrice = 2.99;

        $itemOne->itemQuantity = 12;
        $itemTwo->itemQuantity = 34;
        $itemThree->itemQuantity = 56;

        $this->invoice->setInvoiceItems($itemOne);
        $this->invoice->setInvoiceItems($itemTwo);
        $this->invoice->setInvoiceItems($itemThree);
    }

    public function runProcess()
    {
        $this->invoice = new Invoice();

        $this->createInvoiceItems();
        $this->invoice->calculateInvoice();
        $this->invoice->displayInvoice();

    }
}