<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function store($data, $user_id)
    {
        return Payment::create([
            'course_fee' => $data->course->fee,
            'net_payable' => $data->course->fee,
            'total_paid' => 0,
            'due' => $data->course->fee,
            'enrolment_id' => $data->id,
            'user_id' => $user_id,
        ]);
    }

    public function update($data, Payment $payment)
    {
        return $payment->update($data);
    }
}
