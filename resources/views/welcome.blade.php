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
                    <form method="POST" action="{{ route('calculate') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="loan_amount" class="form-label">Loan Amount</label>
                            <input type="number" class="form-control @error('loan_amount') is-invalid @enderror" name='loan_amount' id="loan_amount"  placeholder="ex. 10,000" required value="@if(isset($allData)) {{$allData['loan_amount']}} @endif">
                            @error('loan_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="interest_rate" class="form-label">Annual Interest Rate</label>
                            <input type="number" class="form-control @error('interest_rate') is-invalid @enderror" name='interest_rate' id="interest_rate"  placeholder="ex. 10%" required>
                            @error('interest_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="loan_term" class="form-label">Loan Term <small class="text-danger fw-bold">* in years</small></label>
                            <input type="number" class="form-control @error('loan_term') is-invalid @enderror" name='loan_term' id="loan_term"  placeholder="ex. 24 years" required>
                            @error('loan_term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="payment_mode" id="payment_mode1" value="1" checked>
                              <label class="form-check-label" for="payment_mode1">
                                Fixed payment
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="payment_mode" id="payment_mode2" value="2">
                              <label class="form-check-label" for="payment_mode2">
                                Extra repayment
                              </label>
                            </div>
                        </div>

                        <div class="mb-3" id="extra_pay_form" style="display: none;">
                            <label for="extra_pay" class="form-label">Extra Pay</label>
                            <input type="number" class="form-control @error('extra_pay') is-invalid @enderror" name='extra_pay' id="extra_pay"  placeholder="ex. 5,000" min="1">
                            <span>in</span>
                            <input type="date" name="extra_pay_date" class="form-control @error('extra_pay_date') is-invalid @enderror">
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
                            <button type="submit" class="btn btn-success">Calculate</button>
                        </div>

                    </form>  
                </div>
            </div>  
        </div>

        <div class="col-md-8">
            <div class="p-3 mb-4 bg-dark text-light rounded-3">
                <table class="table table-dark table-striped text-center">
                    <thead>
                        <tr>
                          <th scope="col">Month Number</th>
                          <th scope="col">Starting Balance</th>
                          <th scope="col">Monthly Payment</th>
                          <th scope="col">Principal</th>
                          <th scope="col">Interest</th>
                          <th scope="col">Remaining balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@section('javascript')

<script type="module">
    
    $('#payment_mode1').click(function() 
    {
        $('#payment_mode1').attr('checked', true);
        $('#payment_mode2').attr('checked', false);
        $('#extra_pay_form').css('display', 'none'); 
    });

    $('#payment_mode2').click(function() 
    {
        $('#payment_mode2').attr('checked', true);
        $('#payment_mode1').attr('checked', false);
        $('#extra_pay_form').css('display', 'block'); 
    });

    $( document ).ready(function() {
        if ($('#payment_mode1').is(':checked')) { 
            $('#extra_pay_form').css('display', 'none');
        }

        if ($('#payment_mode2').is(':checked')) {
            $('#extra_pay_form').css('display', 'block'); 
        }
    });

</script>

@endsection
