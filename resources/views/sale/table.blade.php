<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Sr.</th>
                <th scope="col">Sale Date</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Total Items</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Remark</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_item = count($data);
                $total_qty = 0;
                $total_amount = 0;
            @endphp
             @foreach ($data as $row)
        <tr onclick="rowClick('sale_detail', {{$row->sale_pk}})">
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{ \Carbon\Carbon::parse($row->sale_date)->format('d-m-Y')}}</td>
            <td>{{$row->customer->customer_name}}</td>
            <td>{{$row->count}}</td>
            <td class="text-end">{{formatIndianCurrency($row->total_amount)}}</td>
            <td>{{$row->remark}}</td>

        </tr>
        @php
            $total_qty +=  $row->count;
            $total_amount +=  $row->total_amount;
        @endphp 
        @endforeach
        </tbody>
    </table>
    <div class="text-center mt-4">
         <h5>Purchase : {{$total_item}} | Items : {{$total_qty}} | Amt : {{formatIndianCurrency($total_amount)}}</h5> 
    </div>
    
</div>
{{-- @include('') --}}