@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="text-center mb-5">
                    <h2 class="title-1 ">Message</h2>

                </div>
            </div>





            <div class="mb-5">
               <h3>All Message ({{$contact->total()}}) </h3>
            </div>


            <div class="table-responsive table-responsive-data2 ">
                <table class="table table-secondary table-striped table-hover text-center table-data2">
                    <thead >
                        <tr>
                            <th></th>
                            <th class="fs-6 ">Customer Name</th>
                            <th class="fs-6 " >Customer Email</th>
                            <th class="fs-6">Message</th>
                            <th class="fs-6 col-2" >Date</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach ($contact as $c)
                   <tr class=" tr-shadow">
                    <td></td>
                    <td >{{$c->name}}</td>
                    <td>{{$c->email}}</td>
                    <td class="text-start">{{Str::words($c->message, 10, '....') }}</td>
                    <td>{{$c->created_at->format('F-j-Y')}}</td>
                    <td><a href="{{route('admin#detail',$c->id)}}"><i class="fa-solid fa-angles-right"></i></a></td>
                  </tr>
                   @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                 {{$contact->links()}}
            </div>


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
