@extends('front-end.master')

@section('body')
    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.html">Home</a> / <span>Checkout</span></h3>
        </div>
    </div>
    <!--banner-->

    <!--content-->
    <div class="content">
        <!--single-->
        <div class="single-wl3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 well">
                        <h3>You have to login to complete your valuable order. If you are not registered then please register first.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 well">
                        <h3>Register if you are not registered before!</h3>
                        <br>
                        {{ Form::open(['route'=>'customer-sign-up', 'method'=>'post']) }}
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btn" class="form-control btn btn-info" value="Register">
                            </div>
                        {{ Form::close() }}

                    </div>

                    <div class="col-md-5 well col-md-offset-1">
                        <h3>Already Registered? Login Here!</h3><br>
                        <h4 class="text-danger">{{ Session::get('message') }}</h4>
                        <br>
                        {{ Form::open(['route'=>'customer-login', 'method'=>'POST']) }}
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn" class="form-control btn btn-info" value="Login">
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