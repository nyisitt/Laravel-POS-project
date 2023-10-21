@extends('user.layout.master')
@section('contant')



<a href="{{route('user#home')}}" class=" text-decoration-none"><h2 class="ml-5"><i class="fa-solid fa-arrow-left"></i></h2></a>


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">

                            <img class="w-100 h-100 rounded" src="{{asset('storage/'.$pizza->image)}}" alt="Image">


                    </div>
                             </div>
            </div>

            <div class="col-lg-7 h-auto mb-30 rounded" >
                <div class="h-100 bg-light p-30">
                    <h2>{{$pizza->name}}</h2>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                     <h6 class="pt-1"><i class="fa-solid fa-eye me-3"></i>{{$pizza->view_count + 1}}</h6>
                        <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                        <input type="hidden" value="{{$pizza->id}}" id="pizzaId">
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}}Kyats</h3>
                    <p class="mb-4">{{$pizza->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="pizzaCount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="pizzaCart"><i class="fa fa-shopping-cart mr-1"></i> Add To  Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                   @foreach ($pizzaList as $p )
                   <div class="product-item bg-light rounded">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" class="rounded" style="height: 200px">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="{{route('user#cartList')}}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$p->id)}}"><i class="fa-solid fa-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$p->price}}Kyats</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>

                   @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


@endsection
@section('jsSource')
<script>
    $(document).ready(function(){
// view count ajax
$.ajax({
            type : "get",
            url  : '/ajax/viewCount',
            data : { "productId" : $('#pizzaId').val()},
            dataType : 'json',

           })

// add to cart ajax
        $('#pizzaCart').click(function(){
            $source = {
                "userid" : $('#userId').val(),
                'pizzaId' : $('#pizzaId').val(),
                'count' : $('#pizzaCount').val()
            }
           $.ajax({
            type : "get",
            url  : '/ajax/pizzaCart',
            data : $source,
            dataType : 'json',
            success :function(response){

              if(response.status == 'success'){
                 window.location.href = "/user/home"
               }
            }
           })
        })

})
</script>

@endsection
