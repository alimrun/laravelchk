<?php

namespace Laravelpkg\Laravelchk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaravelchkController extends Controller
{
    public function dmvf(Request $request)
    {
        $post = [
            base64_decode('dXNlcm5hbWU=') => $request[base64_decode('dXNlcm5hbWU=')],//un
            base64_decode('cHVyY2hhc2Vfa2V5') => $request[base64_decode('cHVyY2hhc2Vfa2V5')],//pk
            base64_decode('c29mdHdhcmVfaWQ=') => env(base64_decode(base64_decode('U09GVFdBUkVfSUQ='))),//sid
            base64_decode('ZG9tYWlu') => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];
        $ch = curl_init(base64_decode('aHR0cHM6Ly9jaGVjay42YW10ZWNoLmNvbS9hcGkvdjEvZG9tYWluLWNoZWNr'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        try {
            if (base64_decode(json_decode($response, true)['active'])) {
                session()->put(base64_decode('cHVyY2hhc2Vfa2V5'), $request[base64_decode('cHVyY2hhc2Vfa2V5')]);//pk
                session()->put(base64_decode('dXNlcm5hbWU='), $request[base64_decode('dXNlcm5hbWU=')]);//un
                return redirect()->route(base64_decode('c3RlcDM='));//s3
            }
            return redirect(base64_decode('aHR0cHM6Ly82YW10ZWNoLmNvbS9zb2Z0d2FyZS1hY3RpdmF0aW9u'));
        } catch (\Exception $exception) {
            return redirect(base64_decode('aHR0cHM6Ly82YW10ZWNoLmNvbS9zb2Z0d2FyZS1hY3RpdmF0aW9u'));
        }
    }

    public function actch()
    {
        $post = [
            base64_decode('dXNlcm5hbWU=') => env(base64_decode('QlVZRVJfVVNFUk5BTUU=')),//un
            base64_decode('cHVyY2hhc2Vfa2V5') => env(base64_decode('UFVSQ0hBU0VfQ09ERQ==')),//pk
            base64_decode('c29mdHdhcmVfaWQ=') => env(base64_decode(base64_decode('U09GVFdBUkVfSUQ='))),//sid
            base64_decode('ZG9tYWlu') => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];
        try {
            $ch = curl_init(base64_decode('aHR0cHM6Ly9jaGVjay42YW10ZWNoLmNvbS9hcGkvdjEvYWN0aXZhdGlvbi1jaGVjaw=='));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);
            return response()->json([
                'active' => base64_decode(json_decode($response, true)['active'])
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'active' => 0
            ]);
        }
    }
}
