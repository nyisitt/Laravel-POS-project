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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createpage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- search box --}}

                    <form action="{{route('category#listpage')}}" method="get">
                        @csrf
                    <div class="row my-4">
                        <div class="col-3">
                            <h3>Search Key -<span class="text-danger">{{request('key')}}</span></h3>
                        </div>
                        <div class="col-3 offset-6 d-flex">
                            <input type="text" class="form-control rounded" name="key" placeholder="Search..." value="{{request('key')}}">
                            <button class="btn btn-dark ml-1 rounded" type="submit"><i class='bx bx-search' ></i></button>
                        </div>
                    </div>
                    </form>

                {{-- search end --}}

                {{-- alert box start --}}
                @if (session('createSuccess'))
                <div class="mb-3 col-5 offset-7">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class='bx bx-check-double mr-2  fa-2x'></i>{{session('createSuccess')}}</strong>
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
               <h3>Total<i class='bx bxs-data'></i> {{$categories->total()}}</h3>
            </div>

            @if (count($categories)!= 0)
                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-secondary table-striped table-hover text-center table-data2">
                        <thead >
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item )
                            <tr class=" tr-shadow  ">

                                    <td>{{$item->id}}</td>
                                    <td class="col-5">{{$item->name}}</td>
                                    <td>{{$item->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">

        <a href="{{route('category#edit',$item->id)}}"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="zmdi zmdi-edit"></i>
</button></a>

            <a href="{{route('category#delete',$item->id)}}">
         <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="zmdi zmdi-delete"></i>
         </button>
            </a>

                     </div>
                                </td>
                        </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{$categories->links()}}
                </div>
                    @else
                    <h3 class=" text-center mt-5">There is no Category here!</h3>
                    @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

