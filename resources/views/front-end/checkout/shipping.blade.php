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
                        <h3>Dear {{ Session::get('customerName') }},</h3> <h4>You have to give us product shipping info to complete your valuable order. If your billing info and shipping info are same then just press on save shipping info button.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 well col-md-offset-2">
                        <h3>Shipping Info....</h3>
                        <br>
                        {{ Form::open(['route'=>'new-shipping', 'method'=>'POST']) }}
                        <div class="form-group">
                            <input type="text" name="full_name" value="{{ $customer->first_name.' '.$customer->last_name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn" class="form-control btn btn-info" value="Save Shipping Info">
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
        <!--single-->
    </div>
    <!--content-->
@endsection