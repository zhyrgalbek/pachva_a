<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SmsInformation;
use App\Models\TemporaryUser;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_type' => ['required', 'integer'],
            'last_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:50'],
            'phone' => ['required', 'numeric', 'min:9'],
            'email' => ['nullable', 'string', 'email'],
            'identifier' => ['required', 'string', 'min:14', 'unique:temporary_users,identifier'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'process_personal_data' => ['accepted'],
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    public function redirectUrl(Request $request)
    {
        $token = 'p4qfbyzc7eeybt5uq4b2vafc24c386q9';
        $api = 'https://pochva.24mycrm.com/api.php';
        $body = [
            'action' => 'createUser',
            'type' => $request->input('user_type'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('name'),
            'middle_name' => $request->input('middle_name'),
            'identifier' => $request->input('identifier'),
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'organization_name' => $request->input('organization_name'),
        ];

        $response = Http::withHeaders(['token' => $token])->asForm()->post($api, $body);
        $responseJson = $response->json();

        if (isset($responseJson['success']) && $responseJson['success']) {
            return redirect('https://pochva.24mycrm.com');
        }

        return redirect('/register')->with('error', isset($responseJson['message']) ? $responseJson['message'] : 'Error has occured!');
    }

    /**
     * Create a new user instance after a valid registration.
     * @param array $data
     * @return \App\Models\TemporaryUser
     */

    protected function create(array $data)
    {
        $user = '';
        if ($data['user_type'] == 1 || $data['user_type'] == 2) {

            $smsAmount = count(SmsInformation::whereDate('created_at', Carbon::today())->get());
            if($smsAmount <= 500)
            {
                $remember_token = sha1(uniqid($data['name']));
                $user_id = sha1(uniqid($data['last_name']));
                $smsStatus = $this->sendSMS($data, $remember_token, $user_id);

                if($smsStatus['Comment'] == "Доставлено" || $smsStatus['Comment'] == "Отправлено"){
                    SmsInformation::create([
                        'number' => $this->getValidateNumber($data['phone']),
                        'MessageID' => $smsStatus['MessageID'],
                        'IsError' => $smsStatus['IsError'],
                        'ErrorText' => $smsStatus['ErrorText'],
                        'status' => $smsStatus['Comment'],
                        'dispatch_time' => date(now()),
                    ]);

                    $user = TemporaryUser::create([
                        'user_type' => $data['user_type'],
                        'last_name' => $data['last_name'],
                        'name' => $data['name'],
                        'middle_name' => $data['middle_name'],
                        'organization_name' => $data['organization_name'],
                        'phone' => $this->getValidateNumber($data['phone']),
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'identifier' => $data['identifier'],
                        'registration_request' => date(now()),
                        'remember_token' => $remember_token,
                        'user_id' => $user_id,
                    ]);

                    session(['messageIsSent' => 'send']);
                }
                else{
                    session(['messageIsSent' => false]);
                }
            }
            else{
                session(['messageIsSent' => 'limit']);
            }
        }
        else {
            $user = null;
        }

        return $user;
    }

    private function sendSMS($data, $token, $id)
    {
        $verificationTokenURLs = env('APP_URL') . "verify/token=" . $token . "id=" . $id;
        $message = "Здраствуйте " . $data['name'] . " " . $data['last_name'] . ". Для подтверждения аккаунта перейдите по ссылке: " . $verificationTokenURLs;
        $number = $this->getValidateNumber($data['phone']);

        $postData = [
            "login" => env('SMS_RO_USERNAME'),
            'password'  => env('SMS_RO_PASSWORD'),
            "phone" => "996" . $number,
            "body" => $message,
            'senderName'=> env('SMS_RO_SENDERNAME')
        ];

        $response = Http::post( env('SMS_RO_URL'), $postData);

        $smsStatus = $this->getSmsStatus($response['MessageID']);
        $smsStatus['MessageID'] = $response['MessageID'];
        $smsStatus['IsError'] = $response['IsError'];
        $smsStatus['ErrorText'] = $response['ErrorText'];

        return $smsStatus;
    }

    private function getSmsStatus($messageID)
    {
        $url = "https://api.ro.kg/SmsService.svc/GetMessageState?login=" . env('SMS_RO_USERNAME') . "&password=" . env('SMS_RO_PASSWORD') . "&messageid=" . $messageID;

        $xmlDataString = file_get_contents($url);
        $xmlObject = simplexml_load_string($xmlDataString);
        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true);

        return $phpDataArray;
    }

    private function getValidateNumber($number){
        $j = 1;
        $tempVariable = '';
        if(strlen($number) > 10){
            for($i = strlen($number) - 1; $i >= 1; $i--){
                if($j >= 10){
                    break;
                }
                $tempVariable = $number[$i] . $tempVariable;
                $j++;
            }
            $number = $tempVariable;
        }
        else if(strlen($number) == 10 && strlen($number) > 9){
            for($i = strlen($number) - 1; $i >= 1; $i--){
                if($j >= 10){
                    break;
                }
                $tempVariable = $number[$i] . $tempVariable;
                $j++;
            }
            $number = $tempVariable;
        }

        return $number;
    }

}
