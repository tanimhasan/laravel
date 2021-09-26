<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Shipping;
use Illuminate\Http\Request;
use Mail;
use Session;
use Cart;

class CheckoutController extends Controller
{
    public function index(){
        return view('front-end.checkout.checkout-content');
    }
    public function customerSignUp(Request $request){
        $this->validate($request,[
            'email' => 'email|unique:customers,email'
        ]);
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        $customerId = $customer->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$customer->first_name.' '.$customer->last_name);

        $data = $customer->toArray();
        Mail::send('front-end.mails.confirmation-mail', $data, function ($message) use ($data){
            $message->to($data['email']);
            $message->subject('Confirmation-mail');
        });

        return redirect('/checkout/shipping');
    }
    public function customerLogin(Request $request){
        $customer = Customer::where('email',$request->email)->first();
        if (password_verify($request->password, $customer->password)) {
            Session::put('customerId',$customer->id);
            Session::put('customerName',$customer->first_name.' '.$customer->last_name);
            return redirect('/checkout/shipping');
        } else {
            return redirect('/checkout')->with('message', 'Oi beta! Valid Password de....');
        }
    }
    public function customerLogout(){
        Session::forget('customerId');
        Session::forget('customerName');
        return redirect('/');
    }
    public function newCustomerLogin(){
        return view('front-end.customer.customer-login');
    }



    public function shippingForm(){
        $customer = Customer::find(Session::get('customerId'));
        return view('front-end.checkout.shipping', ['customer'=>$customer]);
    }
    public function saveShippingInfo(Request $request){
        $shipping = new Shipping();
        $shipping->full_name = $request->full_name;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->address = $request->address;
        $shipping->save();

        Session::put('shippingId', $shipping->id);
        return redirect('/checkout/payment');

    }
    public function paymentForm(){
        return view('front-end.checkout.payment');
    }
    public function newOrder(Request $request){
        $paymentType = $request->payment_type;
        if ($paymentType == 'Cash'){
            $order = new Order();
            $order->customerId = Session::get('customerId');
            $order->shippingId = Session::get('shippingId');
            $order->order_total = Session::get('orderTotal');
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_type = $paymentType;
            $payment->save();

            $cartProducts = Cart::content();
            foreach ($cartProducts as $cartProduct){
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id; /*order_id -> Foreign-key*/
                $orderDetail->product_id = $cartProduct->id;
                $orderDetail->product_name = $cartProduct->name;
                $orderDetail->product_price = $cartProduct->price;
                $orderDetail->product_quantity = $cartProduct->qty;
                $orderDetail->save();
            }
            Cart::destroy();
            return redirect('/complete/order');

        }else if ($paymentType == 'Paypal'){

        }else if ($paymentType == 'Bkash'){

        }
    }
    public function completeOrder(){
        return 'success';
    }
}
