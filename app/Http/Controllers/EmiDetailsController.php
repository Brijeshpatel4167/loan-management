<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmiDetailsController extends Controller
{
    /**
     * Show the emi_details index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('emi_details.index');
    }

    /**
     * Calculate EMI and redirect to the emi details page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function process()
    {
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $firstPaymentDate = DB::table('loan_details')->min('first_payment_date');
        $lastPaymentDate = DB::table('loan_details')->max('last_payment_date');

        $columns = ['clientid'];
        $start = new \DateTime($firstPaymentDate);
        $end = new \DateTime($lastPaymentDate);
        while ($start <= $end) {
            $columns[] = $start->format('Y_M');
            $start->modify('+1 month');
        }

        $columnsSql = implode(' decimal(10, 2), ', $columns) . ' decimal(10, 2)';
        DB::statement("CREATE TABLE emi_details ($columnsSql)");

        $loanDetails = DB::table('loan_details')->get();

        foreach ($loanDetails as $loanDetail) {
            $numOfPayment = $loanDetail->num_of_payment;
            $loanAmount = $loanDetail->loan_amount;
            $emiAmount = round($loanAmount / $numOfPayment, 2);

            $emiData = ['clientid' => $loanDetail->clientid];
            $paymentDate = new \DateTime($loanDetail->first_payment_date);
            for ($i = 0; $i < $numOfPayment; $i++) {
                $monthColumn = $paymentDate->format('Y_M');
                $emiData[$monthColumn] = $emiAmount;
                $paymentDate->modify('+1 month');
            }

            DB::table('emi_details')->insert($emiData);
        }

        return redirect()->route('emi.details.show')->with('success', 'Data processed successfully');
    }

    /**
     * Show the emi details page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $emiDetails = DB::table('emi_details')->get();
        return view('emi_details.show', compact('emiDetails'));
    }
}
