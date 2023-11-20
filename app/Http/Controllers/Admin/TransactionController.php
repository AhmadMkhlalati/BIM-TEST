<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\Admin\TransactionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function fetchData()
    {
        $transactions = $this->transactionService->getAllTransactions();
        return response()->json($transactions);
    }

    public function index()
    {
        return Inertia::render('Transaction/index');
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->createTransaction($request->validated());
        return response()->json(['message' => 'Transaction has been created', 'data' => $transaction]);
    }

    public function show(string $id)
    {
        $transaction = $this->transactionService->getTransactionById($id);
        return $transaction;
    }

    public function update(TransactionRequest $request, string $id)
    {
        $this->transactionService->updateTransaction($request->validated(), $id);
        return response()->json(['message' => 'Transaction has been updated']);
    }

    public function destroy(string $id)
    {
        $this->transactionService->deleteTransaction($id);
        return response()->json(['message' => 'Transaction has been deleted']);
    }
}
