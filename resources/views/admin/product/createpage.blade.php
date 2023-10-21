@extends('admin.layout.master')
@section('title','category list')
@section('content')
   <!-- MAIN CONTENT-->
   <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{route('product#lists')}}"><button class="btn bg-dark text-white my-3 rounded">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card rounded " style="background-color: rgb(214, 156, 109);">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Pizza Create</h3>
                                </div>
                                <hr>
                                <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input name="pizzaName" type="text" class="form-control bg-transparent rounded border-black @error('pizzaName')is-invalid @enderror" value="{{old('pizzaName')}}" placeholder="Enter Name...">
                                        @error('pizzaName')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Categories</label>
                                     <select name="category" class="form-control bg-transparent  rounded border-black @error('category')is-invalid @enderror" >
                                            <option value="">Choose Category...</option>
                                            @foreach ($categories as $c)
                                            <option value="{{$c->id}}">{{$c->name
                                            }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Description</label>
                                <textarea name="pizzaDescription" class="form-control bg-transparent  rounded border-black @error('pizzaDescription')is-invalid @enderror" placeholder="Enter Description...." >{{old('pizzaDescription')}}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Image</label>
                           <input type="file" name="pizzaImage" class="form-control bg-transparent border-black rounded @error('pizzaImage')is-invalid @enderror" value="{{old('pizzaImage')}}" >
                                        @error('pizzaImage')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                 <label  class="control-label mb-1">Waiting Time</label>
                           <input type="text" name="time" class="form-control bg-transparent border-black rounded @error('time')is-invalid @enderror" placeholder="Enter waiting time.." value="{{old('time')}}" >
                                        @error('time')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Price</label>
                                        <input name="pizzaPrice" type="text" class="form-control bg-transparent  rounded border-black @error('pizzaPrice')is-invalid @enderror" value="{{old('pizzaPrice')}}" placeholder="Enter Prices...">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback bold">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <span id="payment-button-amount">Create</span>
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

