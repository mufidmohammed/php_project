<?php

declare(strict_types = 1);

function getTransactions($conn): array
{
    $sql = "SELECT * FROM `transactions` WHERE 1";

    $data = $conn -> query($sql);
    
    $transaction = [];

    while ($row = $data -> fetch_assoc())
    {
        $row['date'] = date('M j Y', strtotime($row['date']));
     
        $row['price'] = (float) $row['price'];

        $transaction[] = $row;
    }

    return $transaction;
}

function calculateTotals(array $transactions): array
{
    $totals = ['net' => 0, 'income' => 0, 'expense' => 0];
    foreach($transactions as $transaction) {
        $amount = $transaction["price"];
        if ($amount >= 0) {
            $totals['income'] += $amount;
        } else{
            $totals['expense'] += $amount;
        }
    }

    $totals['net'] = $totals['income'] + $totals['expense'];

    return $totals;
}

function formatDollarAmount(float $amount): string
{
    $isNegative = ($amount < 0) ? '-' : '';
    return $isNegative . '$' . number_format(abs($amount), 2);
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}