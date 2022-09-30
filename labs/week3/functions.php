<?php
    /**
     * Exercise 1) Create functions to add, subtract, divide, multiply two numbers that
     * return the result. Echo the result of each operation and the two input values.
     */
    function add() {
        return "2 + 2 = " . (2 + 2);
    }
    function subtract() {
        return "4 - 1 = " . (4 - 1);
    }
    function divide() {
        return "81 / 9 = " . (81 / 9);
    }
    function multiply() {
        return "6 * 6 = " . (6 * 6);
    }
    echo add() . "<br>" . subtract() . "<br>" . divide() . "<br>" . multiply();

    /**
     * Exercise 2) Create a function that accepts two arguments: a total and a sales
     * tax rate expressed as apercent (so 5% sales is expressed as 0.05). Return
     * the sales tax owed on the total. Then echo the total, the tax rate, and the
     * sales tax owed.
     */
    function salesTax($total, $taxRate) {
        return $total * $taxRate;
    }
    $total = 55;
    $taxRate = 0.05;

    echo "<br><br>Total: $" . ($total + salesTax($total, $taxRate)) .
            "<br>Tax Rate: " . ($taxRate * 100) . "%<br>Sales Tax Owed: $" .
            salesTax($total, $taxRate);
?>