<?php
namespace App\Services\Admin;

use App\Interfaces\Admin\PaymentRepositoryInterface;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->getAllPayments();
    }

    public function createPayment(array $data)
    {
        return $this->paymentRepository->createPayment($data);
    }

    public function updatePayment(array $data, string $id)
    {
        return $this->paymentRepository->updatePayment($data, $id);
    }

    public function deletePayment(string $id)
    {
        return $this->paymentRepository->deletePayment($id);
    }
}
