<?php

namespace Laravelpkg\Laravelchk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaravelchkController extends Controller
{
    public function domain_verification(Request $request)
    {
        // set post fields
        $post = [
            'username' => $request['username'],
            'purchase_key' => $request['purchase_key'],
            'domain' => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];
        $ch = curl_init('https://check.6amtech.com/api/v1/domain-check');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        // do anything you want with your response
        if (base64_decode(json_decode($response, true)['active'])) {
            DB::table('soft_credentials')->insert([
                'key' => 'purchase_key',
                'value' => $request['purchase_key']
            ]);
            DB::table('soft_credentials')->insert([
                'key' => 'username',
                'value' => $request['username']
            ]);
            return redirect('step3');
        }
        return back()->withErrors(['msg', 'Invalid purchase key!']);
    }
}
