<?php

namespace Laravelpkg\Laravelchk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaravelchkController extends Controller
{
    public function domain_verification(Request $request)
    {
        $post = [
            'username' => $request['username'],
            'purchase_key' => $request['purchase_key'],
            'domain' => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];
        $ch = curl_init('https://check.6amtech.com/api/v1/domain-check');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        try {
            if (base64_decode(json_decode($response, true)['active'])) {
                if (DB::table('soft_credentials')->where(['key' => 'purchase_key'])->first()) {
                    DB::table('soft_credentials')->where(['key' => 'purchase_key'])->update([
                        'value' => $request['purchase_key']
                    ]);
                } else {
                    DB::table('soft_credentials')->insert([
                        'key' => 'purchase_key',
                        'value' => $request['purchase_key']
                    ]);
                }

                if (DB::table('soft_credentials')->where(['key' => 'username'])->first()) {
                    DB::table('soft_credentials')->where(['key' => 'username'])->update([
                        'value' => $request['username']
                    ]);
                } else {
                    DB::table('soft_credentials')->insert([
                        'key' => 'username',
                        'value' => $request['username']
                    ]);
                }

                return redirect()->route('step3');
            }
            return redirect('domain-register');
        } catch (\Exception $exception) {
            return back()->withErrors(['msg', 'Invalid purchase key!']);
        }
    }

    public function activate_software(Request $request)
    {
        $post = [
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'purchase_key' => $request['purchase_key'],
            'domain' => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];
        $ch = curl_init('https://check.6amtech.com/api/v1/domain-register');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        try {
            if (base64_decode(json_decode($response, true)['active'])) {

                if (DB::table('soft_credentials')->where(['key' => 'purchase_key'])->first()) {
                    DB::table('soft_credentials')->where(['key' => 'purchase_key'])->update([
                        'value' => $request['purchase_key']
                    ]);
                } else {
                    DB::table('soft_credentials')->insert([
                        'key' => 'purchase_key',
                        'value' => $request['purchase_key']
                    ]);
                }

                if (DB::table('soft_credentials')->where(['key' => 'username'])->first()) {
                    DB::table('soft_credentials')->where(['key' => 'username'])->update([
                        'value' => $request['username']
                    ]);
                } else {
                    DB::table('soft_credentials')->insert([
                        'key' => 'username',
                        'value' => $request['username']
                    ]);
                }

                return redirect()->route('step3');
            }
            return back()->withErrors(['msg', 'Credential does not match.']);
        } catch (\Exception $exception) {
            return back()->withErrors(['msg', 'Credential does not match.']);
        }
    }
}
