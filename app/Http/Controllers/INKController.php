<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class INKController extends Controller
{
    function show()
    {
        return view('ink');
    }

    function getDoc(Request $request)
    {
        $ink = $request->query('ink');
        return view('ink', compact('inkGetDoc'));
    }

    // public function qrcodeDoLoginAction(Request $request)
    // {
    //     $login = $_GET['login']; //jwt or passcode
    //     $key = $_GET['key'];
    //     $sign = $_GET['sign'];
    //     $mem = new \Memcached();
    //     $mem->addServer('127.0.0.1', 11211);
    //     $data = json_decode($mem->get($key), true); // Remove the value of Memcached
    //     if (empty($data)) {
    //         $return = array('status' => 2, 'msg' => 'expired');
    //         return response()->json($return, 200);
    //     } else {
    //         if (!isset($data['sign'])) {
    //             $return = array('status' => 0, 'msg' => 'Sign notset');
    //         }
    //         if ($data['sign'] != $sign) { // Verify delivery Sign
    //             $return = array('status' => 0, 'msg' => 'Verification Error');
    //             // return $this ->createJsonResponse( $return );
    //             return response()->json($return, 403);
    //         }
    //     }
    // }
}
