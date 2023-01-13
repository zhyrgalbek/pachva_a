<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TemporaryUser;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\Concerns\Has;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function verifyAccount($token, $id)
    {
        $user = TemporaryUser::where('user_id', $id)->first();
        $button = "back";
        $message2 = "";
        $header = "Статус аккаунта";
        if($user != ''){
            if($user->remember_token !== $token){
                abort(404);
            }
            elseif($user->user_id !== $id){
                abort(404);
            }
            if($user->verified == false){

                $data = $user->toArray();
                $this->storeUser($user);
                $data['verified'] = true;
                $data['password'] = Hash::make($data['password']);

                if($user->update($data)){

                    $message = __('You have verified your account');
                    $message2 = __('Log in to your personal account, your login is your IIN / PIN that you previously registered');
                    $button = "next";

                }
                else{
                    $message = __('That did not go so repeat the attempt');
                }
            }
            else{
                $message = __('You have already verified your account');
                $message2 = __('Log in to your personal account, your login is your IIN / PIN that you previously registered');
                $button = "next";
            }
        }
        else{
            abort(404);
        }
        return view('auth.verify', compact('header', 'message', 'message2',  'button'));
    }

    public function confirmAccount()
    {
        $header = "Статус";
        $button = "back";
        $message2 = "";
        if(session('messageIsSent') == 'send'){
            $message = __('A message was sent to your number.');
            $message2 = __('Log in to your personal account, your login is your IIN / PIN that you previously registered');
            $button = "next";
        }
        else if(session('messageIsSent') == false){
            $message = __('Something went wrong! The message was not sent, please try again.');
        }
        else if(session('messageIsSent') == 'limit'){
            $message = __('Something went wrong! Exceeded daily limit, please try again later.');
        }
        else{
            abort(404);
        }

        return view('auth.verify',  compact('header', 'message', 'button', 'message2'));
    }

    private function storeUser($user){

        if($user['user_type'] == 1){
            $userType = "fermer";
        }
        else{
            $userType = "sklad";
        }
        $data = [
            'token' => "efkr87hi77fheih9w8ehwfueifh",
            'link_name' => $user['name'],
            'link_lastname' => $user['last_name'],
            'link_otchestvo' => $user['middle_name'],
            'link_mob' => $user['phone'],
            'link_mail' => $user['email'],
            'link_inn' => $user['identifier'],
            'link_type' => $userType,
            'link_org' => $user['organization_name'],
            'link_pass' => $user['password'],
            'action' => 'addUser'
        ];

        return Http::asForm()->post("https://in.sklads.kg/api.php", $data)->toPsrResponse();
    }
}
