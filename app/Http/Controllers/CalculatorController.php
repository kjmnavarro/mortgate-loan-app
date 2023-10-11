<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanSchedule;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'loan_amount' => 'required|gte:1',
            'interest_rate' => 'required|gte:1|max:100',
            'loan_term' => 'required|gte:1|max:50',
            'payment_mode' => 'required',
            'extra_pay' => 'required_unless:payment_mode,1',
            'extra_pay_date' => 'required_unless:payment_mode,1',
            ],
            [
                'loan_amount.gte' => 'Loan amount cannot be negative',
                'interest_rate.gte' => 'Interest rate cannot be negative',
                'loan_term.gte' => 'Loan Term cannot be negative',
                'loan_term.max' => 'Loan Term cannot exceed 50 years',
        ]);

        // Monthly interest rate = (Annual interest rate / 12) / 100
        // Number of months = Loan term * 12
        // Monthly payment = (Loan amount * Monthly interest rate) / (1 - (1 + Monthly interest rate)^(-Number of months))

        if ($validated) {
            $monthly_interest_rate = $this->monthlyInterestRate($validated['interest_rate']);
            $number_of_months = $this->numberOfMonths($request->loan_term);

            $monthly_payment = $this->monthlyPayment($request->loan_amount,$monthly_interest_rate,$number_of_months);

            $allData = [
                'loan_amount' => $validated['loan_amount'],
                'interest_rate' => $validated['interest_rate'],
                'loan_term' => $validated['loan_term'],
                'payment_mode' => $validated['payment_mode'],
                'mir' => $monthly_interest_rate,
                'nom' => $number_of_months,
                'mp' => $monthly_payment,
            ];

            dd($allData);
            // return view('calculated',compact('allData'));
        }
    }

    private function monthlyInterestRate($rate)
    {
        $monthly_interest_rate = (intval($rate)/12) / 100;
        return $monthly_interest_rate;
    }

    private function numberOfMonths($term)
    {
        $number_of_months = $term * 12;
        return $number_of_months;
    }

    private function monthlyPayment($loan,$rate,$months)
    {
        $denominator = 1 - pow(1 + $rate, -$months);
        $monthly_payment = ($loan * $rate) / $denominator;
        return round($monthly_payment,2);
    }
}
