
@extends('user.layout.master')
@section('contant')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5 mt-5" style="height: 400px" >
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover table-striped text-center mb-0" id="tableId">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Order Code</th>
                        <th>Total </th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                    <tr>
                        <td class="align-middle" >{{$o->created_at->format('F-j-Y')}} </td>
                        <td class="align-middle" >{{$o->created_at->format('g:i a')}} </td>
                        <td class="align-middle" >{{$o->order_code}} </td>
                        <td class="align-middle" >{{$o->total_price}} </td>
                        <td class="align-middle" >
                            @if ($o->status == 0)
                            <span class="text-warning"><i class="fa-solid fa-hourglass-half me-2"></i>Pending...</span>
                            @elseif ($o->status == 1)
                           <span class="text-success"> <i class="fa-solid fa-check me-2"></i>Success</span>
                            @elseif ($o->status == 2)
                            <span class="text-danger"><i class="fa-solid fa-exclamation me-3"></i>Reject</span>
                            @endif
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            <div class="mt-3" >{{$order->links()}}</div>

    </div>
</div>
<!-- Cart End -->

@endsection


