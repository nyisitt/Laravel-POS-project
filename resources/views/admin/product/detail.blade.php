@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">

                    <div class="col-lg-10 offset-1 ">
                        <div class="card rounded bg-secondary">
                            <div class="">
                               <i class="fa-solid fa-arrow-left fa-2x ml-2 text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2 mb-5 text-info bold">{{$pizza->category_name}}</h3>
                                </div>
                                <div class="row">
                                    <div class="col-4 offset-2 rounded ">

            <img src="{{asset('storage/'.$pizza->image)}}" alt="John Doe" class="rounded  h-100" />

                                                </div>

                                    <div class="col-5 m-auto ">
        <h4 class="my-3"><i class="fa-solid fa-pizza-slice mr-3"></i>{{$pizza->name}}</h4>
        <h4 class="my-3"><i class="fa-regular fa-clock mr-3"></i>{{$pizza->waiting_time}}min</h4>
        <h4 class="my-3"><i class="fa-solid fa-eye mr-3"></i>{{$pizza->view_count}}</h4>
        <h4 class="my-3"><i class="fa-solid fa-dollar-sign mr-3"></i> {{$pizza->price}} kyats</h4>
                <h4 class="my-3"><i class="fa-solid fa-user-clock mr-3"></i>{{$pizza->created_at->format('j-F-Y')}}</h4>
                                    </div>
                                </div>
                                <div class="my-3">
                                <h4 class=""><i class="fa-regular fa-envelope mr-1"></i>Detail</h4>
                                <p style="text-indent: 50px;">{{$pizza->description}}</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

