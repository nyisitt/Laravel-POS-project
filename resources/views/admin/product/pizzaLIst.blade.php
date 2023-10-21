@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h1 class="title-1 " >Pizza List</h1>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                <i class="zmdi zmdi-plus "></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- search box --}}

                    <form action="{{route('product#lists')}}" method="get">

                    <div class="row my-4">
                        <div class="col-3">
                            <h4>Search Key -<span class="text-danger">{{request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-6 d-flex">
                            <input type="search" class="form-control rounded" name="key" placeholder="Search Name..." value="{{request('key')}}">
                            <button class="btn btn-dark ml-1 rounded" type="submit"><i class='bx bx-search' ></i></button>
                        </div>
                    </div>
                    </form>

                {{-- search end --}}

                {{-- alert box start --}}
                @if (session('update'))
                <div class="mb-3 col-5 offset-7">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class='bx bx-check-double mr-2  fa-2x'></i>{{session('update')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

            @if (session('delete'))
            <div class="mb-3 col-5 offset-7">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class='bx bx-check-double mr-2  fa-2x'></i>{{session('delete')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
            {{-- alert box end --}}
            <div class="">
               <h3>Total<i class='bx bxs-data'></i>  {{$pizza->total()}} </h3>
            </div>

                @if (count($pizza)!= 0)
                <div class="table-responsive table-responsive-data2 mt-3">
                    <table class="table  table-striped table-hover table-waring text-center table-data2" >
                        <thead style="font-size: 30px;">
                            <tr>
                                <th class="fs-5">Image</th>
                                <th class="fs-5"> Name</th>
                                <th class="fs-5">Price</th>
                                <th class="fs-5">Time</th>
                                <th class="fs-5">View </th>
                                <th class="fs-5">Category</th>
                                <th class="fs-5"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizza as $p)
                            <tr class="tr-shadow">
                 <td class="w-25"><img src="{{asset('storage/'.$p->image)}}" class=" img-thumbnail"></td>
                  <td class="fs-6">{{$p->name}}</td>
                  <td class="fs-6">{{$p->price}} Kyats</td>
                  <td class="fs-6">{{$p->waiting_time}}ms</td>
                  <td class="fs-6"><i class="fa-solid fa-eye mr-1"></i>{{$p->view_count}}</td>
                  <td class="fs-6">{{$p->category_name}}</td>
                  <td class="fs-6">
                    <div class="table-data-feature">

     <a href="{{route('product#updatePage',$p->id)}}" class="mr-2 "><button class="item bg-dark" data-toggle="tooltip" data-placement="top"
 title="Edit"><i class="zmdi zmdi-edit"></i></button></a>

     <a href="{{route('product#delete',$p->id)}}"><button class="item bg-dark" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></button></a>

     <a href="{{route('product#detail',$p->id)}}" class="ml-2 "><button class="item bg-dark" data-toggle="tooltip" data-placement="top"
title="See More"><i class="fa-solid fa-angles-right"></i></button></a>
              </div>
            </td>
                            </tr>
                            @endforeach

                      </tbody>
                    </table>
                </div>
                @else
                <h3 class="text-center mt-5">There is no pizza list</h3>
                @endif
                <div class="mt-3">
                    {{$pizza->links()}}
                </div>



                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

