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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>

                </div>
                {{-- search box --}}

                    <form action="{{route('admin#list')}}" method="get">
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
               <h3>Total<i class='bx bxs-data'>{{$admin->total()}}</i></h3>
            </div>

            @if (count($admin)!= 0)
                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-secondary table-striped table-hover text-center table-data2">
                        <thead >
                            <tr>
                                <th>Image</th>
                                <th> Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($admin as $a)
                       <tr class=" tr-shadow">
                        <td class="col-2 ">
                           @if ($a->image == null)
                          @if ($a->gender == 'male')
                          <img src="{{asset('image/default_image.jpg')}}" class=" img-thumbnail">
                          @else
                          <img src="{{asset('image/female_image.jpeg')}}" class=" img-thumbnail">
                          @endif
                           @else
                           <img src="{{asset('storage/'.$a->image)}}" class=" img-thumbnail">
                           @endif
                        </td>
                        <input type="hidden" value="{{$a->id}}" id="roleId">
                        <td> {{$a->name}} </td>
                        <td>{{$a->email}}</td>
                        <td>{{$a->phone}}</td>
                        <td>{{$a->address}}</td>
                        <td>{{$a->gender}}</td>
                        <td>
                    @if (Auth::user()->id == 1)
          @if (Auth::user()->id == $a->id)

          @else
    <div class="d-flex">
        <select class="form-control rounded bg-secondary text-white role" >

            <option value="admin">Admin</option>
            <option value="user">User</option>
         </select>
        <div class="table-data-feature ml-3">
            <a href="{{route('admin#delete',$a->id)}}"><button class="item bg-dark mr-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></button></a>
             </div>

    </div>
    @endif
                    @else


                    @endif
                        </td>
                      </tr>
                       @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                     {{$admin->links()}}
                </div>
                 @else
                    <h3 class=" text-center mt-5">There is no admin account!</h3>
                    @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        $('.role').change(function(){
            $value = $(this).val();
            $parent = $(this).parents('tr');
            $roleId = $parent.find('#roleId').val();
            $data = {
                'value' : $value,
                'roleId': $roleId
            }
            $.ajax({
                  type : 'get',
                  url  : '/admin/ajax/changeRole',
                  dataType : 'json',
                  data : $data,
                  success :function(response){

                  }

                })
                Swal.fire({
  title: 'success',
  icon: 'success',
  })
                location.reload();

        })

    })
</script>

@endsection

