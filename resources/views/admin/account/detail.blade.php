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

                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2 mb-5 text-info bold">Account Info</h3>
                                </div>
                                <div class="row  ">
                                    <div class="col-3 offset-3  rounded ">
                            @if (Auth::user()->image == null)

                            @if (Auth::user()->gender == 'male')
                            <img src="{{asset('image/default_image.jpg')}}" class=" img-thumbnail">
                            @else
                            <img src="{{asset('image/female_image.jpeg')}}" class=" img-thumbnail">
                             @endif
                                        @else
                         <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" class="rounded "/>
                            @endif
                                    </div>
                                    <div class="col-5 ms-3">
        <h4 class="my-3"><i class="fa-solid fa-user mr-3"></i>{{Auth::user()->name}}</h4>
        <h4 class="my-3"><i class="fa-regular fa-envelope mr-3"></i>{{Auth::user()->email}}</h4>
        <h4 class="my-3"><i class="fa-solid fa-phone mr-3"></i>{{Auth::user()->phone}}</h4>
        <h4 class="my-3"><i class="fa-solid fa-children mr-3"></i>{{Auth::user()->gender}}</h4>
        <h4 class="my-3"><i class="fa-solid fa-address-card mr-3"></i>{{Auth::user()->address}}</h4>
        <h4 class="my-3"><i class="fa-solid fa-user-clock mr-3"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                    </div>
                                </div>
                                <div class=" float-end my-3 mr-3">
                                   <a href="{{route('admin#edit')}}"> <button class="btn btn-dark rounded">Edit Profile</button></a>
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

