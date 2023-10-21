@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">

                    <div class="col-lg-6 offset-3">
                        <div class="card bg-transparent rounded border-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                {{-- alertbox section start --}}

                                @if (session('change'))
                                <div class="mb-3 col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><i class='bx bxs-lock-open-alt'></i>{{session('change')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                                @endif

                                @if (session('notChange'))
                                <div class="mb-3 col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><i class='bx bxs-lock-alt' ></i>{{session('notChange')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                                @endif
                                  {{-- alertbox section end --}}
                                <form action="{{route('admin#passwordChange')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Old Password</label>
                                        <input  name="oldPassword" type="password" class="form-control @error('oldPassword')is-invalid @enderror rounded border-dark" placeholder="Enter Old Password...">
                                        @error('oldPassword')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">New Password</label>
                                        <input  name="newPassword" type="password" class="form-control @error('newPassword')is-invalid @enderror rounded border-dark"  placeholder="Enter New Passsword..." >
                                        @error('newPassword')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Confrim Password</label>
                                        <input name="confrimPassword" type="password" class="form-control @error('confrimPassword')is-invalid @enderror rounded border-dark"  placeholder="Enter Confrim Password....">
                                        @error('confrimPassword')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <i class='bx bx-log-out'></i>
                                            <span id="payment-button-amount">Change Password</span>

                                        </button>
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
<!-- END MAIN CONTENT-->
@endsection

