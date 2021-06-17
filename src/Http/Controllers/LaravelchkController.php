<?php

namespace Laravelpkg\Laravelchk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaravelchkController extends Controller
{
    public function check(Request $request){
        // set post fields
        $post = [
            'username' => $request['username'],
            'purchase_key' => $request['purchase_key'],
            'domain'   => url('/'),
        ];
        $ch = curl_init('https://check.6amtech.com/api/v1/domain-check');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        // do anything you want with your response
        dd($response);
    }
}
