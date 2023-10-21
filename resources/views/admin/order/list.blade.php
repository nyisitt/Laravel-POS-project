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
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                </div>

       <form action="{{route('admin#status')}}" method="get">
        <div class=" mb-5 d-flex float-start ">
            @csrf
        <select name="orderStatus" id="status" class="form-control rounded bg-secondary text-white ">
            <option value="">All </option>
          <option value="0" @if (request("orderStatus") == '0')selected @endif>Pending</option>
          <option value="1" @if (request("orderStatus") == '1')selected @endif>Accept</option>
          <option value="2" @if (request("orderStatus") == '2')selected @endif>Reject</option>
      </select>
      <button type="submit" class="btn btn-secondary rounded"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
       </form>



            <div class="float-end">
               <h3>Total<i class='bx bxs-data'></i>{{count($order)}} </h3>
            </div>


                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-secondary table-striped table-hover text-center table-data2 table-borderless">
                        <thead  >
                            <tr >
                                <th class="fs-5">User id</th>
                                <th class="fs-5">User Name</th>
                                <th class="fs-5">Order Code</th>
                                <th class="fs-5">Total Amount</th>
                                <th class="fs-5">Order Date</th>
                                <th class="fs-5">Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <input type="hidden" class="orderId" value="{{$o->id}}">
                  <td class="fs-6">{{$o->user_id}}</td>
                   <td class="fs-6">{{$o->user_name}}</td>
                  <td class="fs-6"><a href="{{route('admin#codeList',$o->order_code)}}">{{$o->order_code}}</a></td>
                  <td class="fs-6" >{{$o->total_price}}Kyats</td>
                  <td class="fs-6">{{$o->created_at->format('F-j-Y')}}</td>
                   <td class="fs-6">
                    <select name="status" class="form-control rounded bg-secondary text-white select" >
                        <option value="0" @if ($o->status == 0)selected @endif>Pending</option>
                        <option value="1" @if ($o->status == 1)selected @endif>Accept</option>
                        <option value="2" @if ($o->status == 2)selected @endif>Reject</option>
                    </select>
                   </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                  {{-- {{$order->links()}} --}}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
 <script>
$(document).ready(function(){
//     $('#status').change(function(){
//        $status =$('#status').val();
//        $.ajax({
//      type : 'get',
//      url  : 'http://127.0.0.1:8000/order/ajax/status',
//      dataType : 'json',
//      data : { 'status' : $status},
//      success :function(response){

//             $list = ""
//          for($i=0; $i<response.length; $i++){
// $Months=['January','February','Math','April','May','June','July','August','September','October','November','December']

//             $dbDate = new Date(response[$i].created_at)
//            $finalDate = $Months[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear()

//            if(response[$i].status == 0){
//             $status =`
//             <select class="form-control rounded bg-secondary text-white select">
//                      <option value="0" selected >Pending</option>
//                      <option value="1"  >Accept</option>
//                      <option value="2" >Reject</option>
//                  </select>
//             `
//            }else if(response[$i].status == 1){
//             $status = `
//             <select name="status" class="form-control rounded bg-secondary text-white select">
//                      <option value="0"  >Pending</option>
//                      <option value="1"  selected>Accept</option>
//                      <option value="2" >Reject</option>
//                  </select>
//             `
//            }else{
//             $status= `
//             <select name="status" class="form-control rounded bg-secondary text-white select">
//                      <option value="0"  >Pending</option>
//                      <option value="1" >Accept</option>
//                      <option value="2"  selected>Reject</option>
//                  </select>
//             `
//            }
//            $list += `
//            <tr class="tr-shadow">

//                <td class="fs-6">${response[$i].user_id}</td>
//                <td class="fs-6">${response[$i].user_name}</td>
//                <td class="fs-6">${response[$i].order_code}</td>
//                <td class="fs-6">${response[$i].total_price}Kyats</td>
//                <td class="fs-6">${$finalDate}</td>
//                 <td class="fs-6">${$status}</td>
//                          </tr>

//            `
//          }

//         $('#dataList').html($list)

//            $(".select").change(function(){

//                 $value = $(this).val()
//                 $parent = $(this).parents("tr");
//                 $orderId =$parent.find('.orderId').val();
//                $data = {
//                 'value' : $value,
//                 'orderId': $orderId
//                }
//                 $.ajax({
//                   type : 'get',
//                   url  : 'http://127.0.0.1:8000/order/ajax/changeStatus',
//                   dataType : 'json',
//                   data : $data,
//                   success :function(response){

//                   }
//                 })

//               })
//                   }
//                         })
//                      })


           //  Change Status
              $(".select").change(function(){

                $value = $(this).val()
                $parent = $(this).parents("tr");
                $orderId =$parent.find('.orderId').val();
               $data = {
                'value' : $value,
                'orderId': $orderId
               }
                $.ajax({
                  type : 'get',
                  url  : '/order/ajax/changeStatus',
                  dataType : 'json',
                  data : $data,
                  success :function(response){

                  }
                })

              })
    })




 </script>

@endsection

