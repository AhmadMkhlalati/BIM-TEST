<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\TransactionRepositoryInterface;
use App\Models\Transaction;

class EloquentTransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::with(['user'])->paginate(10);
    }

    public function createTransaction(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function getTransactionById(string $id)
    {
        return Transaction::findOrFail($id)->with(['user', 'payments'])->first();
    }

    public function updateTransaction(array $data, string $id)
    {
        Transaction::findOrFail($id)->update($data);
    }

    public function deleteTransaction(string $id)
    {
        Transaction::findOrFail($id)->delete();
    }
}
