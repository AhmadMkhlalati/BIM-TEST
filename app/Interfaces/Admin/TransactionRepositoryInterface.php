<?php

namespace App\Interfaces\Admin;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function createTransaction(array $data): Transaction;
    public function getTransactionById(string $id);
    public function updateTransaction(array $data, string $id);
    public function deleteTransaction(string $id);
}
