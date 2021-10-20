
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #5D6975;
        text-decoration: underline;
        }

        body {
        position: relative;
        width: 18cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
        }

        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }

        #logo {
        text-align: center;
        margin-bottom: 10px;
        }

        #logo img {
        width: 90px;
        }

        h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
        }

        #project {
        float: left;
        }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }

        #company {
        float: right;
        text-align: right;
        }

        #project div,
        #company div {
        white-space: nowrap;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }

        table th,
        table td {
        text-align: center;
        }

        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 20px;
        text-align: right;
        }

        table td.service,
        table td.desc {
        vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
        <h2><span style="color:#ef4836">JE</span>SKO</h2>
        <p style="padding: 0; margin:0">Address: Mymensingh, Bangladesh</p>
        <p style="padding: 0; margin:0">Web: jesco.com, E-mail: info@jesco  .com </p>
        <p style="padding: 0 0 10px 0; margin:0">Phone:  01783674575</p>
      <h1>INVOICE 3-2-1</h1>
      <div id="project">
        <div><span style="color: rgb(2, 144, 226); font-size:12px">Bill to</span></div>
        <div><span>CLIENT</span> {{ $billing_Details->name }}</div>
        <div><span>ADDRESS</span> @if ($billing_Details->street_adress1) {{ $billing_Details->street_adress1.',' }} @endif @if ($billing_Details->street_adress2) {{ $billing_Details->street_adress2.',' }} @endif{{ $billing_Details->upazila->name.','.$billing_Details->district->name.','.$billing_Details->division->name }}</div>
        <div><span>EMAIL</span> {{ $billing_Details->email }}</div>
        <div><span>PHONE</span> {{ $billing_Details->phone }}</div>
        <div><span>DATE</span> {{ $billing_Details->created_at->format('d-M-Y') }}</div>
        <div><span>DUE DATE</span> {{ $billing_Details->created_at->format('d-M-Y') }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service" style="background-color: #57B223; color:#fff; font-size:15px">SL</th>
            <th class="service">Product </th>
            <th class="desc">DESCRIPTION</th>
            <th class="desc">Color</th>
            <th class="desc">Size</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th style="background-color: #57B223; color:#fff; font-size:15px">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $order_detail)
                <tr>
                    <td class="service" style="background-color: #57B223; color:#fff; font-size:15px">
                        {{ $loop->index+1 }}

                    </td>
                    <td class="service">
                        {{ App\Models\Product::find($order_detail->product_id)->name }}hello
                    </td>
                    <td class="desc" style="text-align: justify">
                        {{ Str::limit(App\Models\Product::find($order_detail->product_id)->summary,50) }}
                    </td>
                    <td class="desc">
                        {{ App\Models\ProductColor::find($order_detail->color_id)->name }}
                    </td>
                    <td class="desc">
                        {{ App\Models\ProductSize::find($order_detail->size_id)->name }}
                    </td>
                    <td>
                        {{ App\Models\Product::find($order_detail->product_id)->attribute->where('color_id',$order_detail->color_id)->where('size_id',$order_detail->size_id)->first()->offer_price }}
                    </td>
                    <td>{{ $order_detail->quantity }}</td>
                    <td style="background-color: #57B223; color:#fff; font-size:15px">
                        {{ App\Models\Product::find($order_detail->product_id)->attribute->where('color_id',$order_detail->color_id)->where('size_id',$order_detail->size_id)->first()->offer_price *$order_detail->quantity }}
                    </td>
                </tr>
            @endforeach
          <tr>
            <td style="background-color: #57B223; color:#fff; font-size:15px"></td>
            <td colspan="6">DISCOUNT @if($order_summary->discount !=0) ( <span style="color: rgb(74, 74, 240); font-size:10px">{{ $order_summary->voucher_name }} Coupon Applied</span> ) @endif </td>
            <td class="total" style="background-color: #57B223; color:#fff; font-size:15px">
                @if ($order_summary->discount)
                    {{ $order_summary->discount }}
                @else
                    0
                @endif
            </td>
          </tr>
          <tr>
            <td style="background-color: #57B223; color:#fff; font-size:15px"></td>
            <td colspan="6">SHIPPING FEE</td>
            <td class="total" style="background-color: #57B223; color:#fff; font-size:15px">{{ $order_summary->shipping_fee }}</td>
          </tr>
          <tr>
            <td style="background-color: #57B223; color:#fff; font-size:15px"></td>
            <td colspan="6" class="grand total">GRAND TOTAL</td>
            <td class="grand total" style="background-color: #1d2817; color:#fff; font-size:15px">{{ $order_summary->total_price }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laborum nam laudantium explicabo ducimus possimus perferendis illo quasi repellendus iste!</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
