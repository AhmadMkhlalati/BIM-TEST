<?php
namespace App\Repositories\Admin;

use App\Interfaces\Admin\PaymentRepositoryInterface;
use App\Models\Payment;

class EloquentPaymentRepository implements PaymentRepositoryInterface
{
    public function getAllPayments()
    {
        return Payment::paginate(10);
    }

    public function createPayment(array $data): Payment
    {
        $payment = Payment::create($data);

        $transaction = $payment->transaction;
        $transaction->save(); // Update the transaction status based on the new payment.

        return $payment;
    }

    public function updatePayment(array $data, string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($data);

        $transaction = $payment->transaction;
        $transaction->save(); // Update the transaction status based on the updated payment.
    }

    public function deletePayment(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        // Since a payment is deleted, update the transaction status accordingly.
        $transaction = $payment->transaction;
        $transaction->save();
    }
}
