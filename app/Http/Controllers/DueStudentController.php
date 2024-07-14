<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class DueStudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $dues = $payments = Payment::select(['id', 'due', 'user_id', 'enrolment_id'])->with([
            'paymentLogs:id,amount,payment_id',
            'user:id,email',
            'user.student:id,student_id,user_id',
            'enrolment.course:id,name'
        ])->where('due', '>', 0)
            ->withSum('paymentLogs', 'amount')
            ->get();
        // dd($dues);
        return view('due_students.index', compact('dues'));
    }
}
