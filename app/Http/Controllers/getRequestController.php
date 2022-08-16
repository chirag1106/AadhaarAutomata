<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;

class getRequestController extends Controller
{
    public function getAadharService($menu)
    {
        if (isset($menu)) {
            echo $menu;
        } else {
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
            $otp = rand(100000, 999999);
            $this->sendOTP($otp, $request['input_query']);
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

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function send($otp, $phone_number)
    {

        $fields = array(
            "sender_id" => "FastSM",
            "message" => "Your OTP: " . $otp,
            "route" => "v3",
            "numbers" => $phone_number,
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

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
