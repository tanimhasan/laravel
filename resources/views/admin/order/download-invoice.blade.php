<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Billing Info</h1>
    <table border="1">
        <tr>
            <th>Customer Name</th>
            <td>{{ $customer->first_name.' '.$customer->last_name }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $customer->phone }}</td>
        </tr>
    </table>
    <h1>Shipping Info</h1>
    <table border="1">
        <tr>
            <th>Customer Name</th>
            <td>{{ $shipping->full_name }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $shipping->phone }}</td>
        </tr>
    </table>
    <h1>Product Info</h1>
    <table border="1">
        <tr class="bg-primary">
            <th>Sl No</th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Price</th>
        </tr>
        @php($i =1)
        @php($sum =0)
        @foreach($orderDetails as $orderDetail)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $orderDetail->product_id }}</td>
                <td>{{ $orderDetail->product_name }}</td>
                <td>{{ $orderDetail->product_price }}</td>
                <td>{{ $orderDetail->product_quantity }}</td>
                <td>Tk. {{ $total = $orderDetail->product_price * $orderDetail->product_quantity }}</td>
            </tr>
            @php($sum = $sum + $total)
        @endforeach
        <tr>
            <td colspan="4"> </td>
            <th colspan="1">Total Amount</th>
            <td>Tk. {{ $sum }}</td>
        </tr>
    </table>
</body>
</html>