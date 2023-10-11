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

        <div class="col-md-4">
            <div class="p-3 mb-4 bg-dark text-light rounded-3">
                <div class="container-fluid py-5">
                    <h2>Calculated Loan</h2>

                        <div class="mb-3">
                            <label for="c_loan_amount" class="form-label">Loan Amount</label>
                            <input type="number" class="form-control" id="c_loan_amount"  value="{{$allData['loan_amount']}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="c_interest_rate" class="form-label">Annual Interest Rate</label>
                            <input type="number" class="form-control" name='interest_rate' id="c_interest_rate" value="{{$allData['interest_rate']}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="c_loan_term" class="form-label">Loan Term <small class="text-danger fw-bold">* in years</small></label>
                            <input type="number" class="form-control" id="c_loan_term"  value="{{$allData['loan_term']}}" disabled>
                        </div>

                        <div class="mb-3" id="extra_pay_form" style="display: none;">
                            <label for="c_extra_pay" class="form-label">Extra Pay</label>
                            <input type="number" class="form-control" id="c_extra_pay"  value="{{$allData['loan_term']}}">
                            <span>in</span>
                            <input type="date" name="extra_pay_date" class="form-control @error('extra_pay') is-invalid @enderror">
                            @error('extra_pay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('extra_pay_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/" class="btn btn-success">Calculate New</a>
                        </div>
 
                </div>
            </div>  
        </div>

        <div class="col-md-8"></div>

    </div>
</div>
@endsection

@section('javascript')

<script type="module">

</script>

@endsection
