<?php
namespace App\Services\Admin;

use App\Interfaces\Admin\TransactionRepositoryInterface;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getAllTransactions()
    {
        return $this->transactionRepository->getAllTransactions();
    }

    public function createTransaction(array $data)
    {
        return $this->transactionRepository->createTransaction($data);
    }

    public function getTransactionById(string $id)
    {
        return $this->transactionRepository->getTransactionById($id);
    }

    public function updateTransaction(array $data, string $id)
    {
        return $this->transactionRepository->updateTransaction($data, $id);
    }

    public function deleteTransaction(string $id)
    {
        return $this->transactionRepository->deleteTransaction($id);
    }
}
