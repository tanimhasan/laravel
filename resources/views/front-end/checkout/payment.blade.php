@extends('front-end.master')

@section('body')
    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.html">Home</a> / <span>Shipping</span></h3>
        </div>
    </div>
    <!--banner-->

    <!--content-->
    <div class="content">
        <!--single-->
        <div class="single-wl3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 well text-center text-success">
                        <h3>Dear {{ Session::get('customerName') }},</h3> <h4>You have to give us product payment method.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        {{ Form::open(['route'=>'new-order', 'method'=>'POST']) }}
                            <table class="table table-bordered">
                                <tr>
                                    <th>Cash On Delivery</th>
                                    <td><input type="radio" name="payment_type" value="Cash">Cash On Delivery</td>
                                </tr>
                                <tr>
                                    <th>Paypal</th>
                                    <td><input type="radio" name="payment_type" value="Paypal">Paypal</td>
                                </tr>
                                <tr>
                                    <th>Bkash</th>
                                    <td><input type="radio" name="payment_type" value="Bkash">Bkash</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><input type="submit" name="btn" value="Confirm Order"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--single-->
    </div>
    <!--content-->
@endsection