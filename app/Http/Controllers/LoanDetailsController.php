<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanDetailsController extends Controller
{
    /**
     * Show the loan_details index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loanDetails = DB::table('loan_details')->get();
        return view('loan_details.index', compact('loanDetails'));
    }
}
