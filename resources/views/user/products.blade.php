@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('user.layouts.top_widgets')

    <div class="row">

        <div class="col-lg-11 col-md-11 col-sm-12 sg-shadow" style="margin: 3% auto; text-align:center; padding:20px 10px 0 10px;">
            <p>
                @if($subCategories->count() < 0)
                    No Product Categories
                @else
                    @foreach ($subCategories as $category)
                        <a href="#" data-product_type="{{ $category->id }}" class="badge badge-pill badge-success top_category_btn" style="font-size: 14px; margin-bottom:10px;">{{ $category->sub_category_name }}</a>
                    @endforeach
                @endif
            </p>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12" id="productsTableDiv">
            <table id="productsDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="font-size: 11px; width:50px;">TYPE</th>
                        <th style="font-size: 11px; width:30px;">COUNTRY</th>
                        <th style="font-size: 11px; width:300px;">INFORMATION</th>
                        <th style="font-size: 11px; width:15px;">PRICE</th>
                        <th style="font-size: 11px; width:15px; text-align:center;">BUY</th>
                    </tr>
                </thead>
                <tbody id="productsTbody">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->sub_category_name}}</td>
                            <td>{{$product->country}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <a href="#" style="font-size:10px; margin:0!important;" class="btn btn-xs btn-primary buy_btn" data-product_id="{{$product->id}}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <div class="spinner-border spinner-border-sm text-danger" style="display:none;"></div> Buy Now</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $(function(){

            $("#productsDataTable").DataTable();

            // Prodcuts Category buttons at the top
            $('.top_category_btn').on('click', function(e){
                e.preventDefault();
                var category_id = e.currentTarget.dataset.product_type;
                $('#productsDataTable').remove();
                $('#productsDataTable_length').remove();
                $('#productsDataTable_filter').remove();
                $('#productsDataTable_info').remove();
                $('#productsDataTable_paginate').remove();
                $('#productsTableDiv').append(`
                <table id="productsDataTable" width="100%" style="font-size: 100%; width:100%;" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="font-size: 11px; width:50px;">TYPE</th>
                        <th style="font-size: 11px; width:30px;">COUNTRY</th>
                        <th style="font-size: 11px; width:300px;">INFORMATION</th>
                        <th style="font-size: 11px; width:15px;">PRICE</th>
                        <th style="font-size: 11px; width:15px; text-align:center;">BUY</th>
                    </tr>
                </thead>
                <tbody id="productsTbody">
                </tbody>
                </table>
                `);

                $('#productsDataTable').DataTable({
                    ajax: {
                        url: `/product/sub-category/${category_id}`,
                        dataSrc: 'products'
                    },
                    columns:[
                        {data: 'sub_category_name'},
                        {
                            data: 'country',
                            render: function(country){
                                return `${country ? country : 'None'}`;
                            }
                        },
                        {data: 'name'},
                        {
                            data: 'price',
                            render: function(price){
                                return `$${price}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(id){
                                return `
                                <a href="#" style="font-size:10px; margin:0!important;" class="btn btn-xs btn-primary buy_btn" data-product_id="${id}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <div class="spinner-border spinner-border-sm text-danger" style="display:none;"></div> Buy Now</a>
                                `;
                            }
                        }
                    ]
                });

                // Add To Cart Button - Buy Now
                addToCart();
            });
            // END ---- Prodcuts Category buttons at the top

            function addToCart()
            {
                // Add To Cart Button - Buy Now
                $('#productsTbody').on('click', '.buy_btn', function(e){
                    e.preventDefault();
                    var product_id = e.currentTarget.dataset.product_id;
                    $.ajax({
                        url: `/cart/${product_id}`,
                        method: 'GET',
                        beforeSend: function(){
                            e.currentTarget.children[1].style.display = "inline-block";
                            e.currentTarget.children[0].style.display = "none";
                            e.currentTarget.setAttribute('disabled', true);
                        },
                        complete: function(){
                            e.currentTarget.children[1].style.display = "none";
                            e.currentTarget.children[0].style.display = "inline-block";
                            e.currentTarget.setAttribute('enabled', true);
                        },
                        success: function(res){
                            if(res.success){
                                e.currentTarget.parentNode.parentNode.remove();
                                $.ajax({
                                    url: '/cart/count/orderItems',
                                    method: 'GET',
                                    success: function(res){
                                        $("#countOrderItems").siblings().remove();
                                        $(`<span class="badge bg-green">${res.countOrderItems ? res.countOrderItems : '0'}</span>`).insertAfter($("#countOrderItems"));
                                    }
                                });
                            }
                        }
                    });
                });
                // END - Add To Cart Button - Buy Now
            }
            addToCart();
        });
    </script>
@endsection
