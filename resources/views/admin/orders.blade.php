@extends('admin.layouts.admin-master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('admin.partials.top_widgets')

    <div class="row">

        <div class="col-md-4 col-sm-12 mt-5">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>ORDER PROFIT</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="animated flipInY">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i>
                          </div>
                          <div class="count" id="total_profit">0</div>

                          <h3>TOTAL PROFIT</h3>
                        </div>
                      </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12 mt-5">
            <div class="x_panel sg-shadow">
                <div class="x_title">
                    <h2>{{ $title }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="ordersDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; width:100px;">ORDER NUMBER</th>
                                <th style="font-size: 11px; width:200px;">USERNAME</th>
                                <th style="font-size: 11px; width:150px;">AMOUNT(USD)</th>
                                <th style="font-size: 11px; width:150px;">AMOUNT(BTC)</th>
                                <th style="font-size: 11px; width:150px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTbody">
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
        function fetchAllOrders()
        {
            $("#ordersDataTable").DataTable({
                ajax:{
                    url: '/admin/order/all',
                    method: 'GET',
                    dataSrc: 'orders'
                },
                columns:[
                    {data: "code"},
                    {data: "username"},
                    {
                        data: "local_amount",
                        render: function(local_amount){
                            return `$${local_amount}`;
                        }
                    },
                    {data: "bitcoin_amount"},
                    {
                        data: "state",
                        render: function(state){
                            var status;
                            if(state === "charge:confirmed"){
                                status = "<span class='badge badge-success badge-pill' style='font-size:14px;'>Confirmed</span>";
                            }
                            if(state === "charge:pending"){
                                status = "<span class='badge badge-info badge-pill' style='font-size:14px;'>Pending</span>";
                            }
                            if(state === "charge:failed"){
                                status = "<span class='badge badge-danger badge-pill' style='font-size:14px;'>Failed</span>";
                            }
                            if(state === "charge:delayed"){
                                status = "<span class='badge badge-info badge-pill' style='font-size:14px;'>Delayed</span>";
                            }
                            if(state === "created"){
                                status = "<span class='badge badge-info badge-pill' style='font-size:14px;'>Pending</span>";
                            }

                            return `${status}`;
                        }
                    }
                ],
                "scrollY": true
            });
        }
        fetchAllOrders()


        function fetchOrderProfit()
        {
            $.ajax({
                url: '/admin/order/profit',
                method: 'GET',
                success: function(res){
                    if(res.profits){
                        $("div#total_profit").text(`$${res.profits ? res.profits.toFixed(2) : '0.00'}`);
                    }
                }
            });
        }
        fetchOrderProfit();
    });
</script>

@endsection
