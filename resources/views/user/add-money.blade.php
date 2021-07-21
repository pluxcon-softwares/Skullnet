@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('user.layouts.top_widgets')

    <div class="row mt-5">
        <div class="col-md-4 col-sm-12">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>Bitcoin (BTC) Payment</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="text-align: center;">
                    <h4>We Accept BTC <i class="badge badge-success badge-pill">Online</i></h4>
                    <img src="{{asset('images/bitcoin.png')}}" class="sg-shadow img-circle img-thumbnail mb-3" width="75px" height="75px" alt="">

                    <form method="POST" action="{{ route('deposit') }}">
                        @csrf
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text" style="background-color: #F5365C; color:#fff;">$</div>
                        </div>
                        <input type="text" name="deposit" class="form-control" placeholder="Deposit Amount">
                            <div class="input-group-append">
                                <input type="submit" value="Deposit" style="background-color: #F5365C; color:#fff; border:none;">
                            </div>
                    </div>
                     @if($errors->has('deposit'))
                            <span style="font-size: 14px; font-weight:bold; color:#F5365C;">{{ $errors->first('deposit') }}</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">

            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>History of Payments</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-hover table-condensed" id="paymentHistoryDataTable">
                        <thead>
                            <tr>
                                <th>Amount (USD)</th>
                                <th>Amount (BTC)</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment_history as $payment)
                            <tr>
                                <td>${{ $payment->local_amount }}</td>
                                <td>{{ $payment->bitcoin_amount }}</td>
                                <td>{{ $payment->address }}</td>
                                <td>
                                    @switch($payment->state)
                                        @case('charge:created')
                                            <span class="badge badge-info badge-pill" style="font-size: 12px;">Pending | Wait for 3 confirmations</span>
                                            @break
                                        @case('charge:pending')
                                            <span class="badge badge-info badge-pill" style="font-size: 12px;">Pending | Wait for 3 confirmations</span>
                                            @break
                                        @case('charge:confirmed')
                                            <span class="badge badge-success badge-pill" style="font-size: 12px;">Confirmed | Wallet has been funded</span>
                                            @break
                                        @case('charge:failed')
                                            <span class="badge badge-danger badge-pill" style="font-size: 12px;">Failed | Payment canceled</span>
                                            @break
                                        @case('charge:delayed')
                                            <span class="badge badge-info badge-pill" style="font-size: 12px;">Delayed | Payment processing delayed. Wallet Funded</span>
                                            @break

                                    @endswitch
                                </td>
                                <td>{{ $payment->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $(function(){
            $('#paymentHistoryDataTable').DataTable({});
        });
    </script>
@endsection
