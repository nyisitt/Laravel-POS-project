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
                        <div class="card rounded ">
                            <a href="{{route('product#lists')}}"><button class="btn btn-dark rounded ml-3 mt-3"><i class="fa-solid fa-arrow-left-long "></i></button></a>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center mb-5 fa-2x ">Pizza Update</h3>
                                </div>
                      <form action="{{route('product#update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$pizza->id}}">
                        <div class="row  ">
                            <div class="col-6 offset-3  rounded  ">

     <img src="{{asset('storage/'.$pizza->image)}}" alt="John Doe" class="rounded w-100 h-100" />
                            </div>
                        </div>
                        <div class="row col-4 offset-4 mt-3">
                            <input type="file" name="pizzaImage" class="@error('pizzaImage')is-invalid @enderror">
                            @error('pizzaImage')
                            <div class="invalid-feedback text-warning ">
                                {{$message}}
                            </div>
                        @enderror
                        </div>

                       <div style="background: brown;" class="mt-5 rounded">
                        <div class="row  col-8 offset-2 ">
                            <div class="form-group mt-3">
                                <label for="" class="control-label mb-1 text-white">Name</label>
                                <input  name="pizzaName" type="text" class="form-control rounded bg-transparent text-white @error('pizzaName')is-invalid @enderror"  placeholder="Enter pizzaName..." value="{{old('pizzaName',$pizza->name)}}">
                                @error('pizzaName')
                                    <div class="invalid-feedback text-warning  ">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1 text-white">Price</label>
                                <input  name="pizzaPrice" type="text" class="form-control rounded bg-transparent  text-white @error('pizzaPrice')is-invalid @enderror"  placeholder="Enter pizzaPrice..." value="{{old('pizzaPrice',$pizza->price)}}">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback text-warning ">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                        <label for="" class="control-label mb-1 text-white">Description</label>
                     <textarea name="pizzaDescription" class="form-control rounded bg-transparent  text-white @error('pizzaDescription')is-invalid @enderror" placeholder="Enter pizzaDescription">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback text-warning ">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                            <label for="" class="control-label mb-1 text-white">Category</label>
                   <select name="category" class="form-control text-warning rounded bg-transparent @error('category')is-invalid @enderror" >
                    <option value="" >Choose category...</option>
                    @foreach($category as $c)
                    <option value="{{$c->id}}"@if ($c->id == $pizza->category_id) selected    @endif>{{$c->name}}</option>

                    @endforeach
                   </select>
                   @error('category')
                   <div class="invalid-feedback text-warning ">
                       {{$message}}
                   </div>
               @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label mb-1 text-white">Waiting Time</label>
                                <input  name="time" type="text" class="form-control rounded bg-transparent  text-white @error('time')is-invalid @enderror"  placeholder="Enter time..." value="{{old('time',$pizza->waiting_time)}}">
                                @error('time')
                                    <div class="invalid-feedback text-warning ">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                            <label for="" class="control-label mb-1 text-white">View Count</label>
                                <input  name="viewCount" type="text" class="form-control rounded bg-transparent text-white"  placeholder="Enter New Passsword..." value="{{old('viewCount',$pizza->view_count)}}" disabled>
                                  </div>

                            <div class="form-group">
                    <label for="" class="control-label mb-1 text-white">Created Time</label>
                                <input  name="created_at" type="text" class="form-control rounded bg-transparent text-white "  placeholder="Enter New Passsword..." value="{{old('created_at',$pizza->created_at->format('j-F-Y'))}}" disabled>
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
<!-- END MAIN CONTENT-->
@endsection

