@extends('admin.master')

@section('body')
    <style>
        .lab label{margin-top: 5px;}
    </style>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="page-wrap">

                        <h1 id="header">INVOICE</h1>

                        <div id="identity">
                            <div class="address">
                                <h4>Shipping Info</h4>
                                <p>{{ $shipping->full_name }}</p>
                                <p>{{ $shipping->address }}</p>
                                <p>{{ $shipping->phone }}</p>
                            </div>
                            <div class="address">
                                <h4>Billing Info</h4>
                                <p>{{ $customer->first_name.' '.$customer->last_name }}</p>
                                <p>{{ $customer->address }}</p>

                                <p>{{ $customer->phone }}</p>

                            </div>
                        </div>
                        <div id="logo">
                            <a href="#"><img src="{{ asset('/') }}admin/invoice/images/logo.png" alt="logo" /></a>
                        </div>

                        <div style="clear:both"></div>

                        <div id="customer">
                            <table id="meta">
                                <tr>
                                    <td class="meta-head">Invoice #</td>
                                    <td>0000{{ $order->id }}</td>
                                </tr>
                                <tr>

                                    <td class="meta-head">Date</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="meta-head">Amount Due</td>
                                    <td>Tk. {{ $order->order_total }}</td>
                                </tr>

                            </table>

                        </div>

                        <table id="items">

                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                            @php($sum =0)
                            @foreach($orderDetails as $orderDetail)
                                <tr class="item-row">
                                    <td>{{ $orderDetail->product_name }}</td>
                                    <td>Description</td>
                                    <td>Tk. {{ $orderDetail->product_price }}</td>
                                    <td>{{ $orderDetail->product_quantity }}</td>
                                    <td>Tk. {{ $total = $orderDetail->product_price * $orderDetail->product_quantity }}</td>
                                </tr>
                                @php($sum = $sum + $total)
                            @endforeach

                            <tr>
                                <td colspan="3" class="blank"> </td>
                                <td colspan="1" class="total-line">Total Amount</td>
                                <td class="total-value"><div id="subtotal">Tk. {{ $sum }}</div></td>
                            </tr>

                        </table>

                        <div id="terms">
                            <h5>Terms</h5>
                            <h6>New Shop Website</h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection