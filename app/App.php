<?php

declare(strict_types = 1);

function getTransactionFiles(string $dirPath): array
{
    $files = [];
    foreach(scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $files[] = $dirPath . $file;
    }

    return $files;
}

function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if(! file_exists($fileName)) {
        trigger_error('File "' . $fileName . '" does not exist', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    $transactions = [];

    fgetcsv($file);

    while ($transaction = fgetcsv($file)) {
        $transactions[] = $transactionHandler($transaction);
    }

    fclose($file);

    return $transactions;
}

function extractTransaction(array $transactionRow): array
{
    // Takes a transaction and format the output as needed
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '', $amount);
    
    return [
        'date'        => date('M j Y', strtotime($date)),
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount'      => $amount,
    ];
}

function calculateTotals(array $transactions): array
{
    $totals = ['net' => 0, 'income' => 0, 'expense' => 0];
    foreach($transactions as $transaction) {
        $amount = $transaction['amount'];
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
