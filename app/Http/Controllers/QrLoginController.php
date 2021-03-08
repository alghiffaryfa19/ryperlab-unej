<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class QrLoginController extends Controller
{
    public function qrlogin(Request $request) {
        $result =0;
        if ($request->data) {
            $user = User::where('id',$request->data)->first();
            if ($user) {
                Auth::login($user);
                $result = 1;
            }else{
                $result = 0;
            }  
        }
           
        return $result;
   }
}