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
                    <h2>Deposit - Payment Canceled</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="text-align: center;">
                    <h4>Payment has been canceled, you can still add funds -OR- visit homepage my using the buttons below</h4>
                    <a href="{{ route('add.money') }}" class="btn btn-sm btn-success">Add Funds</a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-danger">Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
