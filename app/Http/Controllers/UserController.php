<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getUser()
    {
    	return request()->user();
    }

    public function buyCredits()
    {
    	$user = request()->user();

    	if(!$user->hasPaymentMethod())
    		return response()->json(['error' => 'No payment method set up'], 404);

    	$paymentMethod = $user->defaultPaymentMethod()->asStripePaymentMethod();

    	$amount = request()->price * 100;

    	$payment = $user->charge($amount, $paymentMethod);

    	if($payment->status == 'succeeded')
    		$user->deposit(request()->credit);

    	return response()->json(['balance' => $user->balance], 200);
    }	

    public function getCredits()
    {
    	$user = request()->user();

    	if( $user->stripe_id != null )
    		return response()->json(['balance' => $user->balance], 200);

    	return response()->json(['error' => 'No payment method set up'], 404);
    }

    public function getPaymentMethods()
    {
    	$user = request()->user();

	    $methods = array();

	    if( $user->hasPaymentMethod() ){
	        foreach( $user->paymentMethods() as $method ) {        	
	            array_push( $methods, [
	                'id' => $method->id,
	                'holder_name' => $method->billing_details->name,
	                'brand' => $method->card->brand,
	                'last_four' => $method->card->last4,
	                'exp_date' => $method->card->exp_month.'/'.$method->card->exp_year
	            ] );
	        }
	    }

	    return response()->json( $methods );
    }

    public function postPaymentMethods(){

	    $user = request()->user();

	    $paymentMethodID = request()->get('payment_method');

	    if( $user->stripe_id == null ) {
	        $user->createAsStripeCustomer();
	        $user->wallet()->create();
	    }

	    $user->addPaymentMethod( $paymentMethodID );

	    $user->updateDefaultPaymentMethod( $paymentMethodID );
	    
	    return response()->json( null, 204 );        
	}

	public function removePaymentMethod(){
	    $user = request()->user();
	    $paymentMethodID = request()->get('id');

	    $paymentMethods = $user->paymentMethods();

	    foreach( $paymentMethods as $method ){
	        if( $method->id == $paymentMethodID ){
	            $method->delete();
	            break;
	        }
	    }
	    
	    return response()->json( null, 204 );
	}
}
