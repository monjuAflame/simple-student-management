<?php

namespace App\Console\Commands;

use App\Mail\DueStudentMail;
use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all due users by running this comman';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $payments = Payment::select(['id', 'course_fee', 'total_paid', 'due', 'user_id', 'enrolment_id'])->with([
            'paymentLogs:id,amount,payment_id',
            'user:id,email,first_name,last_name',
            'user.student:id,student_id,user_id',
            'enrolment.course:id,name'
        ])->where('due', '>', 0)
            ->get();

        foreach ($payments as $item) {
            Mail::to($item->user->email)->send(new DueStudentMail($item));
        }

        logger('successfull mailed');
    }
}
