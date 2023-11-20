<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Services\Admin\PaymentService;
use Inertia\Inertia;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function fetchData()
    {
        $payments = $this->paymentService->getAllPayments();
        return response()->json($payments);
    }

    public function index()
    {
        return Inertia::render('Payment/index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $payment = $this->paymentService->createPayment($request->validated());

        return response()->json(['message' => 'Payment has been created', 'data' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, string $id)
    {
        $this->paymentService->updatePayment($request->validated(), $id);

        return response()->json(['message' => 'Payment has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentService->deletePayment($id);

        return response()->json(['message' => 'Item has been deleted']);
    }
}
