<?php
require_once('ProcessInvoice.php');

class InvoiceTestDrive
{
    public function main()
    {
        $processInvoice = new ProcessInvoice();
        $processInvoice->runProcess();
    }
}
$test = new InvoiceTestDrive();
$test->main();