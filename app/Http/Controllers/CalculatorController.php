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

        if ($validated) {

            $monthly_interest_rate = $this->monthlyInterestRate($validated['interest_rate']);
            $number_of_months = $this->numberOfMonths($request->loan_term);

            $monthly_payment = $this->monthlyPayment($request->loan_amount,$monthly_interest_rate,$number_of_months);

            $startingBalance = $validated['loan_amount'];
            $startingDate = date("Y-m-d");
            $data_id = rand(1,10000);

            $extraPayDate=strtotime($validated['extra_pay_date']);
            $check1=date("F Y",$extraPayDate);

            for ($month = 1; $month <= $number_of_months; $month++) {
                $interestComponent = $startingBalance * $monthly_interest_rate;
                $principalComponent = $monthly_payment - $interestComponent;
                $endingBalance = $startingBalance - $principalComponent;
     
                $date_of_payment = date('Y-m-d', strtotime('+1 month', strtotime($startingDate)));
                $startingDateChecks=strtotime($date_of_payment);
                $check2=date("F Y",$startingDateChecks);

                if($check1 == $check2){
                    $principalComponent += $validated['extra_pay'];
                    $endingBalance -= $validated['extra_pay']; 
                }

                $schedule = new LoanSchedule([
                    'data_id' => $data_id,
                    'date_of_payment' => $date_of_payment,
                    'month_number' => $month,
                    'starting_balance' => $startingBalance,
                    'monthly_payment' => $monthly_payment,
                    'principal_component' => $principalComponent,
                    'interest_component' => $interestComponent,
                    'ending_balance' => $endingBalance
                ]);
                $schedule->save();

                $startingBalance = $endingBalance;
                $startingDate = $date_of_payment; 
            }
                    
            $allData = [
                'loan_amount' => $validated['loan_amount'],
                'interest_rate' => $validated['interest_rate'],
                'loan_term' => $validated['loan_term'],
                'payment_mode' => $validated['payment_mode'],
            ];
            
            return redirect()->route('calculated', ['id' => $data_id]);
        }
    }

    public function calculated($id)
    {
        $getLoanData = LoanSchedule::where('data_id',$id)->get();
        return view('calculated', compact('getLoanData'));
    }

    private function monthlyInterestRate($rate)
    {
        $monthly_interest_rate = (intval($rate)/12) / 100;
        return round($monthly_interest_rate,3);
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
