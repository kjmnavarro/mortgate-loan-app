@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="p-2 mb-4 bg-dark text-light rounded-3 ">
              <div class="container-fluid py-5 text-center">
                <h1 class="display-5 fw-bold">Welcome to Mortgage Loan Calculator App</h1>
                <p>This is a Coding Solution for Mortgage Loan Calculation of Kieffer John M. Navarro.</p>
              </div>
            </div>

        </div>

        {{-- <div class="col-md-4">
            <div class="p-3 mb-4 bg-dark text-light rounded-3">
                <div class="container-fluid py-5">
                    <h2>Calculated Loan</h2>

                        <div class="mb-3">
                            <label for="c_loan_amount" class="form-label">Loan Amount</label>
                            <div id="c_loan_amount" class="calculated_data">{{$allData['loan_amount']}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="c_interest_rate" class="form-label">Annual Interest Rate</label>
                            <div id="c_interest_rate" class="calculated_data">{{$allData['interest_rate']}} <small class="text-danger fw-bold">%</small></div>
                        </div>
                        <div class="mb-3">
                            <label for="c_loan_term" class="form-label">Loan Term <small class="text-danger fw-bold">* in years</small></label>
                            <div id="c_loan_term" class="calculated_data">{{$allData['loan_term']}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="c_payment_mode" class="form-label">Payment mode <small class="text-danger fw-bold">* in years</small></label>
                            <div id="c_payment_mode" class="calculated_data">{{$allData['payment_mode']=1 ? 'Fixed Payment' : 'Extra Repayment'}}</div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/" class="btn btn-success">Calculate New</a>
                        </div>
 
                </div>
            </div>  
        </div> --}}

        <div class="col-md-8">
            <div class="p-3 mb-4 bg-dark text-light rounded-3">
                <table class="table table-dark table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Date of Payment</th>
                            <th scope="col">Month Number</th>
                            <th scope="col">Starting Balance</th>
                            <th scope="col">Monthly Payment</th>
                            <th scope="col">Principal</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Remaining balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getLoanData as $d)
                        <tr>
                            <td>{{$d->date_of_payment}}</td>
                            <td>{{$d->month_number}}</td>
                            <td>{{$d->starting_balance}}</td>
                            <td>{{$d->monthly_payment}}</td>
                            <td>{{$d->principal_component}}</td>
                            <td>{{$d->interest_component}}</td>
                            <td>{{$d->ending_balance}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@section('javascript')

<script type="module">

</script>

@endsection
