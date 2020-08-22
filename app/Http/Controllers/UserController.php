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
    	# code...
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

	    if( $user->stripe_id == null )
	        $user->createAsStripeCustomer();

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
