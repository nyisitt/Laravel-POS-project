@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->



                <a href="{{route('admin#orderListPage')}}" class="fs-3 text-dark"><i class="fa-solid fa-arrow-left"></i></a>

              <div class="row col-5">
                <div class="card rounded bg-secondary text-white mt-3">
                    <h3 class="text-center my-2">Order Info</h3>
                    <small class="text-center text-warning">( with Delivery Fee 3000)</small>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-user me-2 text-dark"></i>Name</div>
                            <div class="col">{{$orderList[0]->user_name}}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-barcode me-2 text-dark"></i>Order Code</div>
                            <div class="col">{{$orderList[0]->order_code}}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-clock me-2 text-dark"></i>Date</div>
                            <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col"><i class="fa-solid fa-money-bill-1-wave me-2 text-dark"></i>Total Price</div>
                            <div class="col">{{$order->total_price}}</div>
                        </div>
                    </div>
                </div>
              </div>


                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-secondary table-striped table-hover text-center table-data2 table-borderless">
                        <thead  >
                            <tr >
                                <th></th>
                                <th class="fs-6">Order id</th>

                                <th class="fs-6">Product Image</th>
                                <th class="fs-6">Product Name</th>
                                <th class="fs-6">Qty</th>
                                <th class="fs-6">Amount</th>

                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $ol)
                            <tr class="tr-shadow">
                                <td></td>
                                <td class="text-center">{{$ol->id}}</td>
                                <td class="col-2"><img src="{{asset('storage/'.$ol->product_image)}}" class="rounded"></td>
                                <td>{{$ol->product_name}}</td>
                                <td>{{$ol->qty}}</td>
                                <td>{{$ol->total}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


