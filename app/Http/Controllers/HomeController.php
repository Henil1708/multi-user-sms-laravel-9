<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function smsSend(Request $request){

        $validator = Validator::make($request->all(), [
           'numbers' => 'required',
           'message' => 'required'
       ]);

       if ( $validator->passes() ) {

        try {

            $numbers_in_arrays = explode( ',' , $request->input( 'numbers' ) );


            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $from  = env('TWILIO_FROM');

            $client = new Client($sid,$token);

            $count = 0;

            foreach( $numbers_in_arrays as $number )
            {
                $count++;

                    $client->messages->create('+91'.$number,[
                        'from'=>$from,
                        'body'=>$request->message,
                    ]);
            }

           return back()->with( 'success', $count . " messages sent!" );


        } catch (\Exception $th) {
            return $th->getMessage();
        }
       } else {
           return back()->withErrors( $validator );
       }



    }
}
