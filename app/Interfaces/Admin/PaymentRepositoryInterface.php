<?php
namespace App\Interfaces\Admin;

use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function getAllPayments();
    public function createPayment(array $data): Payment;
    public function updatePayment(array $data, string $id);
    public function deletePayment(string $id);
}
