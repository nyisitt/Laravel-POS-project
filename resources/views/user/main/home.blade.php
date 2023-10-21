
@extends('user.layout.master')
@section('contant')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                <div class="bg-light p-3 mb-30 rounded">

                        <div class="mb-3 d-flex justify-content-between">

                            <h3 class="">Categories</h3>
                            <h5 class="mt-2">{{count($category)}}</h5>
                        </div>
                        <hr style="background: yellow; font-weight:bolder;">
                        <a href="{{route('user#home')}}" class="text-decoration-none"><h5 class="shadow text-center py-2 mb-3">All</h5></a>
                        @foreach ($category as $c)
                        <div class="  text-center mb-3">
                            <a href="{{route('user#filter',$c->id)}}" class=" text-decoration-none "><h5 class="shadow py-2">{{$c->name}}</h5></a>

                        </div>

                        @endforeach

                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
              {{-- cart list --}}
                       <a href="{{route('user#cartList')}}">
                        <button type="button" class="btn btn-dark position-relative text-warning rounded">
                            Cart <i class="fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark fs-6">
                                {{count($cart)}}
                          </span>
                          </button>
                       </a>
               {{-- history List --}}
               <a href="{{route('user#cartHistory')}}">
                <button type="button" class="btn btn-dark position-relative text-warning rounded ml-3">
                    History  <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark fs-6">
                        {{count($history)}}
                  </span>
                  </button>
               </a>

                            </div>
                            <div class="ml-2">

                                <div class="dropdown">

                                      <select name="" id="sorting" class="form-control rounded bg-dark text-warning">
                                        <option value="">Choose Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">descending</option>
                                      </select>
                                  </div>
                            </div>
                        </div>
                    </div>

                   <div class="row" id="append">
                 @if (count($pizza)!= 0)
                 @foreach ($pizza  as $p)
                 <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                  <div class="product-item bg-light mb-4 rounded">
                      <div class="product-img position-relative overflow-hidden">
                          <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" class="rounded" style="height: 200px">
                          <div class="product-action">
                              <a class="btn btn-outline-dark btn-square" href="{{route('user#cartList')}}"><i class="fa fa-shopping-cart"></i></a>
                              <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$p->id)}}"><i class="fa-solid fa-info"></i></a>

                          </div>
                      </div>
                      <div class="text-center py-4">
                          <h3 class="" >{{$p->name}}</h3>
                          <div class="d-flex align-items-center justify-content-center mt-2">
                          <h6>{{$p->price}}Kyats</h6>
                          </div>

                      </div>
                  </div>
              </div>
                 @endforeach
                 @else
                    <div class="text-center btn btn-dark col-6 offset-3 py-3"><h2 class=" text-warning">There is no Pizza <i class="fa-solid fa-pizza-slice ml-2 text-white"></i></h2></div>
                 @endif
                   </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('jsSource')
<script>
    $(document).ready(function(){
//   $.ajax({
//     type : 'get',
//     url  : 'http://127.0.0.1:8000/ajax/pizzaList',
//     dataType : 'json',
//     success :function(response){
//         console.log(response)
//     }
//   })
$('#sorting').change(function(){
    $event = $('#sorting').val()
    if($event == 'asc'){
        $.ajax({
     type : 'get',
     url  : '/ajax/pizzaList',
     data : { 'status' : 'asc'},
     dataType : 'json',
     success :function(response){
         $list = ""
         for($i=0; $i<response.length; $i++){
           $list += `
           <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                        <div class="product-item bg-light mb-4 rounded">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" class="rounded" style="height: 200px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h3 class="" >${response[$i].name}</h3>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6>${response[$i].price}Kyats</h6>
                                </div>

                            </div>
                        </div>
                    </div>
           `
         }
        $('#append').html($list)
     }
   })
    }else if($event == 'desc'){
        $.ajax({
     type : 'get',
     url  : '/ajax/pizzaList',
     data : { 'status' : 'desc'},
     dataType : 'json',
     success :function(response){
        $list = ""
         for($i=0; $i<response.length; $i++){
           $list += `
           <div class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                        <div class="product-item bg-light mb-4 rounded">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" class="rounded" style="height: 200px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h3 class="" >${response[$i].name}</h3>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6>${response[$i].price}Kyats</h6>
                                </div>

                            </div>
                        </div>
                    </div>
           `
         }
        $('#append').html($list)

     }
   })
    }
})
})
</script>

@endsection
