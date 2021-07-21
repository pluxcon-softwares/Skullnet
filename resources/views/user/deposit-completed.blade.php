@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('user.layouts.top_widgets')

    <div class="row mt-5">
        <div class="col-md-6 col-sm-12 ml-auto mr-auto">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>Deposit - Payment Completed</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="text-align: center;">
                    <h5>Payment to deposit funds to your wallet was successfully</h5>
                    <h4>Please wait for 3 confirmations from the blockchain and your money will reflect in your wallet.</h4>
                    <p style="color: red; font-weight:bold;">Click the button below to check your payment status</p>
                    <a href="{{ route('add.money') }}" class="btn btn-sm btn-success">Payment History</a>
                </div>
            </div>
        </div>
    </div>
@endsection
