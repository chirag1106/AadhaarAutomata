<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;
use App\Models\aadhaar_details;
use App\Models\updateMenu;
use Exception;

class getRequestController extends Controller
{
    private $otp;
    private $phone;

    public function updateAadhaar($query)
    {
        if(($query)){
            $menu = updateMenu::where('id','=',1)->get()->first()->toArray();


            $arr = ['status' => 'true', 'menu' => json_encode($menu) ];
            print_r(json_encode($arr));
        }
    }

    public function processQuery(Request $request)
    {
        $validated = null;
        // dd($request->query_type);
        if ($request['query_type'] != 'phone') {
            $request->validate(
                [
                    'input_query' => 'required',
                    'query_type' => 'required'
                ],
                [
                    'query_type.required' => 'Sorry! can not process your query',
                    'input_query.required' => 'Please enter your query'
                ]
            );
            if ($request['query_type'] != 'otp') {

            } else {
                // dd($this->otp);
                if ($request['input_query'] == Session::get('otp')) {
                    $arr = ['status' => 'true', 'message' => 'Welcome! Chirag, How may I help?', 'menu' => 'firstMenu'];
                    print_r(json_encode($arr));
                }
                else{
                    $arr = ['status' => 'false', 'message' => 'Wrong OTP! Kindly enter correct otp.'];
                    print_r(json_encode($arr));
                }
            }
        } else {
            $request->validate(
                [
                    'input_query' => 'required| min:10| max:10',
                    'query_type' => 'required'
                ],
                [
                    'query_type.required' => 'Sorry! can not process your query',
                    'input_query.required' => 'Please enter your Phone Number',
                    'input_query.min' => 'Kindly enter 10 digits Phone Number',
                    'input_query.max' => 'Kindly enter 10 digits only'
                ]
            );

            $phone = $request['input_query'];
            try{
                $user_details  = aadhaar_details::where('contact_number','=',$phone)->get()->toArray();
            }
            catch(Exception $e){
                $arr = ['status' => 'false', 'error_message' => $e->getMessage(), 'message' => 'SQL error!'];
                print_r(json_encode($arr));
            }
            // dd(array_values($user_details));
            $request->session()->put('user', $user_details);

            if(!empty($user_details)){
                $this->otp = rand(100000, 999999);
                // dd($this->otp);
                $request->session()->put('otp', $this->otp);
                $response = $this->sendOTP($this->otp, $request['input_query']);
                // dd($response);
                if(json_decode($response[0])->return == 'true'){

                    $arr = ['status' => 'true', 'message' => 'OTP sent successfully to your phone number.'];
                    print_r(json_encode($arr));
                }
                else{
                    $arr = ['status' => 'false', 'message' => 'OTP couldn\'t sent successfully.'];
                    print_r(json_encode($arr));
                }
            }
            else{
                $arr = ['status' => 'false', 'message' => 'This phone number is not registered.'];
                print_r(json_encode($arr));
            }
        }
    }

    public function sendOTP($otp, $phone_number)
    {
        $fields = array(
            "variables_values" => $otp,
            "route" => "otp",
            "numbers" => $phone_number
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: vRyBF39AqeCfM8otjEPcl0zQKmhd5sLJ6UOpGgZWi1YxDVITNSRbtU4fOYpV1whlzLSq60cKFmXoBNZI",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return [$response, $err];
        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
    }

}
