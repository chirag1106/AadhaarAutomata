<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;
use App\Models\aadhaar_details;
use App\Models\payment;
use App\Models\updateMenu;
use App\Models\updateQuery;
use Exception;

class getRequestController extends Controller
{
    private $otp;
    private $phone;

    public function updateAadhaar($query)
    {
        if ($query == "updateMenu") {
            $menu = updateMenu::where('id', '=', 1)->get()->first()->toArray();

            $arr = ['status' => 'true', 'menu' => $menu];
            print_r(json_encode($arr));
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
            if ($request['query_type'] != 'otp') {
            } else {
                // dd($this->otp);
                if ($request['input_query'] == Session::get('otp')) {
                    $arr = ['status' => 'true', 'message' => 'Welcome! '.Session::get('name').', How may I help?', 'menu' => 'firstMenu'];
                    print_r(json_encode($arr));
                } else {
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
            try {
                $user_details  = aadhaar_details::where('contact_number', '=', $phone)->get()->toArray();
            } catch (Exception $e) {
                $arr = ['status' => 'false', 'error_message' => $e->getMessage(), 'message' => 'SQL error!'];
                print_r(json_encode($arr));
            }
            // dd(array_values($user_details));
            $request->session()->put('user', $user_details);
            $request->session()->put('phone', $phone);
            foreach($user_details as $user){
                $request->session()->put('name', $user['name'] );
                $request->session()->put('address', $user['address']);
                $request->session()->put('gender', $user['gender']);
                $request->session()->put('dob', $user['date_of_birth']);
                $request->session()->put('phone', $user['contact_number']);
            }


            if (!empty($user_details)) {
                $this->otp = rand(100000, 999999);
                // dd($this->otp);
                $request->session()->put('otp', $this->otp);

                $response = $this->sendOTP($this->otp, $request['input_query']);
                // dd($response);
                if (json_decode($response[0])->return == 'true') {

                    $arr = ['status' => 'true', 'message' => 'OTP sent successfully to your phone number.'];
                    print_r(json_encode($arr));
                } else {
                    $arr = ['status' => 'false', 'message' => 'OTP couldn\'t sent successfully.'];
                    print_r(json_encode($arr));
                }
            } else {
                $arr = ['status' => 'false', 'message' => 'This number is not linked to aadhaar.'];
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

    public function followUpMsg($msg){
        $response = $this->sendSMS($msg, Session::get('phone') );
        if (json_decode($response[0])->return == 'true') {

            $arr = ['status' => 'true', 'message' => 'Follow up sms send successfully'];
            print_r(json_encode($arr));
        } else {
            $arr = ['status' => 'false', 'message' => 'sms service is down.'];
            print_r(json_encode($arr));
        }

    }

    public function sendSMS($msg, $phone_number)
    {
        $fields = array(
            "sender_id" => "FTWSMS",
            "message" => $msg,
            "route" => "v3",
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

    public function updatePayment(Request $request){
        // dd($request->paymentID);
        $user = Session::get('user');
        $name = "";
        $aadhaar = "";
        foreach($user as $person){
            $name = $person['name'];
            $aadhaar = $person['aadhar_number'];
        }
       $amount = 50;
       $paymentStatus = $request->status;
       $paymentID = $request->paymentID;
       $addedON = date("Y-m-d");

       $paymentForm = new payment();

       $paymentForm->aadhaar_no = $aadhaar;
       $paymentForm->name = $name;
       $paymentForm->amount = $amount;
       $paymentForm->payment_status = $paymentStatus;
       $paymentForm->payment_id = $paymentID;
       $paymentForm->added_on = $addedON;

       $result = $paymentForm->save();



    }

    public function updateForm(Request $request){

        // dd($request['']);

        $currentName = Session::get('name');
        $newName = $request->input('new-name');
        $documentName = $request->input('document-name');
        $documentNumber = $request->input('document-number');
        $image = $request->file('uploaded-document');
        // $new_image_name = rand().'.'.$image->getClientOriginalExtension();
        // $image->move(public_path('images'), $new_image_name);

        // $imagePath = './images/'.$new_image_name;
        // dd($imagePath);

        $query = new updateQuery();
        $query->current_name = $currentName;
        $query->new_name = $newName;
        $query->document_name = $documentName;
        $query->document_number = $documentNumber;
        // $query->uploaded_document = $image;

        $result = $query->save();

        print_r($result);

    }
}
