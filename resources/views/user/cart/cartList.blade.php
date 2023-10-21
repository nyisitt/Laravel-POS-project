@extends('user.layout.master')
@section('contant')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5 mt-5">
        <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-light table-borderless table-hover table-striped text-center mb-0" id="tableId">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                 @foreach ($cart as $c)
                 <tr>
                    <td><img src="{{asset('storage/'.$c->image)}}" class="rounded" style="width: 100px;"> </td>
                    <td class="align-middle">
                        {{$c->pizzaName}}
                        <input type="hidden" value="{{$c->id}}" id="cartId">
                        <input type="hidden" value="{{$c->user_id}}" id="userId">
                        <input type="hidden" value="{{$c->product_id}}" id="productId">
                    </td>
                    <td class="align-middle" id="price">{{$c->pizzaPrice}} Kyats</td>
                    {{-- <input type="hidden" value="{{$c->pizzaPrice}}" id="price"> --}}
                    <td class="align-middle">
                        <div class="input-group quantity mx-auto" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-minus"  id="minus">
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}" id="qty">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-plus" id="plus">
                                    <i class="fa fa-plus" ></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle" id="total">{{$c->pizzaPrice * $c->qty}} Kyats</td>
                    <td class="align-middle"><button class="btn btn-sm btn-danger remove" ><i class="fa fa-times"></i></button></td>
                </tr>
                 @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="sum">{{$totalPrice}} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivary</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalSum">{{$totalPrice + 3000}} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 rounded" id="order">Proceed To Checkout</button>

                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 rounded" id="clear">Clear Carts</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection
@section('jsSource')
<script>
    $(document).ready(function(){
        //  when + button click
        $('.btn-plus').click(function(){
            $parent =$(this).parents('tr')
            $price =Number($parent.find('#price').text().replace('Kyats',''))
             $qty = Number($parent.find('#qty').val())
             $total = $price * $qty
        $parent.find('#total').html($total+ 'Kyats')

            finalSum()
        })
        //  when - button click
            $('.btn-minus').click(function(){
            $parent =$(this).parents('tr')
            $price =Number($parent.find('#price').text().replace('Kyats',''))
            $qty = Number($parent.find('#qty').val())
             $total = $price * $qty
                $parent.find('#total').html($total+ 'Kyats')

                finalSum()
           })
            // when delete button click
           $('.remove').click(function(){
             $parent = $(this).parents('tr')
              $cartId = $parent.find('#cartId').val()
            $.ajax({
              type : 'get',
              url  : 'http://127.0.0.1:8000/ajax/clearItem',
              data : {'cartId': $cartId},
             dataType : 'json',
                  })
      $parent.remove()
            finalSum()
                                       })



        //    when clear cart button
        $('#clear').click(function(){
            $('#tableId tbody tr').remove();
            $('#sum').html('0 kyats');
            $('#finalSum').html('3000 kyats')

             $.ajax({
      type : 'get',
      url  : 'http://127.0.0.1:8000/ajax/clearAll',
      dataType : 'json',
      success :function(response){
               if(response.status == 'true'){
              window.location.href = "http://127.0.0.1:8000/user/home"
                                            }
                                 }
                  })
                                    })


           function finalSum(){
            $finalPrice=0
        $('#tableId tbody tr').each(function(index,row){
            $finalPrice += Number($(row).find('#total').text().replace('Kyats',''))
        })
       $('#sum').html(`${$finalPrice} Kyats`)
       $('#finalSum').html(`${$finalPrice + 3000} Kyats`)
                             }

        })

</script>
<script>
    $(document).ready(function(){
        $("#order").click(function(){
         $orderList=[];
         $random = Math.floor(Math.random()*10000000)
         $('#tableId tbody tr').each(function(index,row){

            $orderList.push({
                'userId' : $(row).find('#userId').val(),
                'productId' : $(row).find('#productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total':$(row).find('#total').text().replace('Kyats','')*1,
                'orderCode' : $random,
                           })
                                                       })

            //   console.log($orderList)
            $.ajax({
     type : 'get',
     url  : '/ajax/orderList',
     dataType : 'json',
     data : Object.assign({}, $orderList),
     success :function(response){
        if(response.status == 'true'){
            window.location.href = "/user/home"
                                      }
                                }
                     })
                         })

    })
</script>

@endsection

