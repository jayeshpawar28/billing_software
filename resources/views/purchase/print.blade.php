<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link href="{{ asset('css/invoice_style.css') }}" rel="stylesheet">

</head>
<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <h1>RECEIPT</h1>
        <div id="company" class="clearfix">
            <h4>Bill From :</h4>
            <div>Billing Soft</div>
            <div>Indira Nagar,<br /> Nashik, Maharashtra</div>
            <div>7249095504 / (602) 519-0450</div>
            <div>jayesh281103@gmail.com</div>
        </div>
        <div id="project">
            <h4>Bill To :</h4>
            <div><span>SUPPLIER </span> {{$data->supplier->supplier_name}}</div>
            <div><span>CONTACT</span> {{$data->supplier->mobile}}</div>	
            <div><span>ADDRESS</span> {{$data->supplier->address}}</div>
            <div><span>DATE</span> {{ \Carbon\Carbon::parse($data->purchase_date)->format('d-m-Y')}}</div>
            <div><span>BILL NO. </span> {{$data->bill_no}}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Sr.</th>
                    <th class="desc">Product Name</th>
                    <th>Rate</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($purchse_products as $row)
                <tr>
                    <td class="service grand total">{{ $loop->iteration }}</td>
                    <td class="desc grand total">{{ $row->product->product_name }}</td>
                    <td class="unit grand total">{{ formatIndianCurrency($row->rate) }}</td>
                    <td class="qty grand total">{{ $row->qty }}</td>
                    <td class="total grand total">{{ formatIndianCurrency($row->amount) }}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <div id="payment_section">
            <div id="payment_details">
                <h3>Total Amount : <span class="amount"> @if ($data->total_amount){{formatIndianCurrency($data->total_amount)}} @endif </span></h3>
                <h3>Paid Amount :<span class="amount">  @if ($data->paid_amt){{formatIndianCurrency($data->paid_amt)}} @endif </span></h3>
                <h3>Pending Amount :<span class="amount">  @if ($data->pending_amt){{formatIndianCurrency($data->pending_amt)}} @endif </span></h3>
                @if ($data->remark)
                <h3>Remark : <span class="amount"> {{$data->remark}} </span></h3>
                @endif
            </div>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">Please make a pending payment within 30 days from the Receipt date.</div>
            </div>
        </div>
        <div id="signature_section">
            <div class="signature_label">Signature</div>
        </div>
    </main>
    <footer>
        Receipt was created on a Computer.
    </footer>
</body>
</html>
