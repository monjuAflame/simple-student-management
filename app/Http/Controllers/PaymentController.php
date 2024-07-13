<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\PaymentLog;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $payment = Payment::where('id', $data['payment_id'])->first();

        if (($data['amount']) > $payment->due)
            return $this->returnFailedResponse('Amount is greater then payable amount.');

        try {
            $log = PaymentLog::create([
                'amount' => $data['amount'],
                'method' => $data['method'],
                'remark' => $data['remark'],
                'payment_id' => $payment->id,
                'enrolment_id' => $data['enrolment_id'],
                'created_by' => auth()->id(),
            ]);

            if ($log) {
                $payment->total_paid += $data['amount'];
                $payment->due -= $data['amount'];
                $payment->save();
            }
            return redirect()->back()->with('message', 'Payment Successfully Added.');
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->returnFailedResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    private function returnFailedResponse($message = null)
    {
        $message = $message ?? 'Something went wrong!';
        return back()->withInput()->with('error', $message);
    }
}
