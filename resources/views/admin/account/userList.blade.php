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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                </div>
                {{-- search box --}}

                    <form action="{{route('admin#userlist')}}" method="get">
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
            </div>

            {{-- alert box end --}}
            <div class="float-end my-3 me-5">
               <h3>Total<i class='bx bxs-data'>{{$user->total()}}</i></h3>
            </div>

            @if (count($user)!= 0)
                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-secondary table-striped table-hover text-center table-data2">
                        <thead >
                            <tr>
                                <th class="fs-6">Image</th>
                                <th class="fs-6"> Name</th>

                                <th class="fs-6">Phone</th>
                                <th class="fs-6">Address</th>
                                <th class="fs-6">Gender</th>
                                <th class="fs-6">Role</th>
                                <th class="fs-6">Ban State</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($user as $u)
                       <tr class=" tr-shadow">
                        <td class="col-2 ">
                           @if ($u->image == null)
                          @if ($u->gender == 'male')
                          <img src="{{asset('image/default_image.jpg')}}" class=" img-thumbnail">
                          @else
                          <img src="{{asset('image/female_image.jpeg')}}" class=" img-thumbnail">
                          @endif
                           @else
                           <img src="{{asset('storage/'.$u->image)}}" class=" img-thumbnail">
                           @endif
                        </td>
                        <input type="hidden" value="{{$u->id}}" id="roleId">
                        <td> {{$u->name}} </td>

                        <td>{{$u->phone}}</td>
                        <td>{{$u->address}}</td>
                        <td>{{$u->gender}}</td>
                        <td>

            <select class="form-control rounded bg-secondary text-white role" >

            <option value="admin">Admin</option>
            <option value="user" selected>User</option>
         </select>

                        </td>
                        <td class="col-2">
                    <select class="form-control rounded bg-secondary text-white ban" >

                                <option value="1" @if ($u->suspend == 1) selected @endif>Ban</option>
                                <option value="0" @if ($u->suspend == 0) selected @endif>Active</option>
                             </select>
                        </td>
                      </tr>
                       @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                     {{$user->links()}}
                </div>
                 @else
                    <h3 class=" text-center mt-5">There is no user account!</h3>
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
                  url  : 'http://127.0.0.1:8000/admin/ajax/changeRole',
                  dataType : 'json',
                  data : $data,

                })

                Swal.fire({
  title: 'success',
  icon: 'success',
})
location.reload();
        })

        // suspend section
        $('.ban').change(function(){
            // console.log($(this).val());
           $value = $(this).val();
           $parent = $(this).parents('tr');
           $roleId = $parent.find('#roleId').val();
           $data = {
                'value' : $value,
                'roleId': $roleId
            }
            // console.log($data)
            $.ajax({
                  type : 'get',
                  url  : '/admin/ajax/banState',
                  dataType : 'json',
                  data : $data,

                })
        })
    })
</script>

@endsection

