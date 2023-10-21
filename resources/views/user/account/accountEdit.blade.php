
@extends('user.layout.master')
@section('contant')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">

                    <div class="col-lg-8 offset-2 ">
                        <div class="card rounded ">
            
                            {{-- alert box start --}}
                            @if (session('update'))
                            <div class="mb-3 col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><i class='bx bxs-lock-open-alt'></i>{{session('update')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                            @endif
                            {{-- alert box end --}}

                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2 text-white bg-dark w-50 m-auto py-3 rounded">Account Profile</h3>
                                </div>
                      <form action="{{route('account#update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data" class="mt-5">
                        @csrf
                        <div class="row  ">
                            <div class="col-4 offset-4  rounded  ">
                                @if (Auth::user()->image == null)

                                @if (Auth::user()->gender == 'male')
                                <img src="{{asset('image/default_image.jpg')}}" class=" rounded" width="100%">
                                @else
                                <img src="{{asset('image/female_image.jpeg')}}" class=" rounded" width="100%">
                                @endif
                                @else
                             <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" class="rounded " width="100%"/>
                                @endif
                            </div>
                        </div>
                        <div class="row col-4 offset-4 mt-3">
                            <input type="file" name="image" class="@error('image')is-invalid @enderror">
                            @error('image')
                            <div class="invalid-feedback bold">
                                {{$message}}
                            </div>
                        @enderror
                        </div>

                       <div style="background:pink; " class="mt-5 rounded">
                        <div class="row  col-8 offset-2 ">
                            <div class="form-group mt-3">
                                <label for="" class="control-label mb-1">Name</label>
                                <input  name="name" type="text" class="form-control rounded bg-transparent  border-dark @error('name')is-invalid @enderror"  placeholder="Enter Name..." value="{{old('name',Auth::user()->name)}}">
                                @error('name')
                                    <div class="invalid-feedback bold">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Email</label>
                                <input  name="email" type="email" class="form-control rounded bg-transparent  border-dark @error('email')is-invalid @enderror"  placeholder="Enter email..." value="{{old('email',Auth::user()->email)}}">
                                @error('email')
                                    <div class="invalid-feedback bold">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Phone</label>
                                <input  name="phone" type="text" class="form-control rounded bg-transparent border-dark @error('phone')is-invalid @enderror"  placeholder="Enter phone..." value="{{old('phone',Auth::user()->phone)}}">
                                @error('phone')
                                    <div class="invalid-feedback bold">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Gender</label>
                   <select name="gender" class="form-control rounded bg-transparent border-dark  @error('gender')is-invalid @enderror">
                    <option value="">Choose gender...</option>
             <option value="male"@if(Auth::user()->gender == 'male')selected @endif>Male</option>
        <option value="female" @if(Auth::user()->gender == 'female')selected @endif>Female</option>
                   </select>
                   @error('gender')
                   <div class="invalid-feedback bold">
                       {{$message}}
                   </div>
               @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Address</label>
                                <input  name="address" type="text" class="form-control rounded bg-transparent border-dark @error('address')is-invalid @enderror"  placeholder="Enter address..." value="{{old('address',Auth::user()->address)}}">
                                @error('address')
                                    <div class="invalid-feedback bold">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1">Role</label>
                                <input  name="role" type="text" class="form-control rounded bg-transparent border-dark @error('role')is-invalid @enderror"  placeholder="Enter New Passsword..." value="{{old('role',Auth::user()->role)}}" disabled>
                                @error('role')
                                    <div class="invalid-feedback bold">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                       </div>
                       <div class="mt-3 float-end ">
                       <input type="submit" value="Update" class="btn btn-dark rounded">
                       </div>
                      </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
