@extends('admin.layout.master')

@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <a href="{{route('admin#contactPage')}}" class="fs-2 text-dark"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="col-lg-8 offset-2 ">
                        <div class="card rounded bg-secondary">

                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2 mb-5 text-info bold">Message </h3>
                                </div>
                            <h5 style="text-indent: 50px; line-height:2;">
                                {{$message->message}}
                            </h5>


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
