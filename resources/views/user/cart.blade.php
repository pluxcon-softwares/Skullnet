@extends('user.layouts.master')

@section('title')
    @if (isset($title))
        {{$title}}
    @endif
@endsection

@section('content')

@include('user.layouts.top_widgets')

<div class="row mt-5">
    <div class="col-md-8 mr-auto ml-auto">
      <div class="x_panel sg-shadow">
        <div class="x_title">
          <h2>Shopping Cart</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <section class="content invoice">
            <!-- title row -->
            <div class="row">
              <div class="  invoice-header">
                <h1>
                    <i class="fa fa-shopping-cart"></i> Order Item(s).
                </h1>
              </div>
              <!-- /.col -->
            </div>

            <!-- Table row -->
            <div class="row">
              <div class="  table">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ItemNumber</th>
                      <th>Product Type</th>
                      <th style="width: 59%">Product</th>
                      <th>Subtotal</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="orderItemsTbody">
                    @if ($orderItems->count() > 0)
                        @foreach ($orderItems as $item)
                            <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product_type }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="subtotal">${{ $item->price }}</td>
                            <td><a href="#" class="delete_item" style="padding: 5px; background-color:red; color:#ffffff; border-radius:5px;" data-delete_item="{{$item->id}}"><i class="fa fa-remove"></i></a></td>
                          </tr>
                        @endforeach
                    @endif

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-md-6">
                <p class="lead">Payment Methods:</p>
                <img src="{{asset('images/bitcoin.png')}}" width="20" height="20" alt="Bitcon(BTC)"> Bitcoin(BTC)
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <strong>NOTE:</strong>Your product(s) can be processed when you have enough funds in your wallet
                    to cover full payment of products in cart.
                    Make sure you have funded your wallet -OR- topup before payment. Thank You!
                </p>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <p class="lead">Amount Due {{ date('Y-m-d') }}</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th style="width:50%">Total:</th>
                        <td id="total_price">${{ $totalPrice ? $totalPrice : '0.00' }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <p>
                    <button class="btn btn-success pull-right" id="makePayment"><i class="fa fa-credit-card"></i> Make Payment</button>
                </p>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </section>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra_script')
    <script>
        $(function(){
            function removeItemInCart()
            {
                $("#orderItemsTbody").on('click', '.delete_item', function(e){
                    e.preventDefault();
                    var orderItemID = e.currentTarget.dataset.delete_item;
                    $.ajax({
                        url: '/cart/delete-order-item/'+orderItemID,
                        method: 'GET',
                        success: function(res){
                            if(res.status === 200){
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            removeItemInCart();

            function makePayment()
            {
                $("#makePayment").on('click', function(){
                    $.ajax({
                        url: '/cart/process-order',
                        method: 'GET',
                        success: function(res){
                            if(res.empty_cart){
                                swal({
                                    title: "Shopping Cart",
                                    text: res.empty_cart,
                                    icon: "error"
                                })

                                window.location.replace('/home');
                            }

                            if(res.error){
                                swal({
                                title: "Shopping Cart",
                                text: res.error,
                                icon: "error"
                                })
                            }

                            if(res.success){
                                swal({
                                title: "Purchase Order",
                                text: res.success,
                                icon: "success"
                                });
                                window.location.replace("/cart/thank-you");
                            }
                        }
                    });
                });
            }
            makePayment();
        });
    </script>
@endsection
