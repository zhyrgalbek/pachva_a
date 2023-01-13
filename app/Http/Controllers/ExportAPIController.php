<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use CURLFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class ExportAPIController extends Controller
{
    public function generatePDF(){
        $data = \request()->all();
        $data = array_keys($data);
        $data = \GuzzleHttp\json_decode($data[0], true);
        $apiUrl = "https://in.sklads.kg/uploadPDF.php";
//        Storage::disk('public')->put('req' . now()->second . '.txt', print_r($data, 1));

        try {
            if($data['moduleName'] == 'Storecertificate'){
                if(isset($data['fieldName'])){
//                    $name = $data['id'] . "_" .date('YdmHis') .".pdf";
                    $name = $data['id'] .".pdf";
                    $data['url'] = "https://in.sklads.kg/storage/uploads/" . $name;

                    if(isset($data['store']['inn'])){
                        $data['store_inn'] = $data['store']['inn'];
                    }
                    else{
                        $data['store_inn'] = '';
                    }

                    if(isset($data['account']['inn'])){
                        $data['account_inn'] = $data['account']['inn'];
                    }
                    else{
                        $data['account_inn'] = '';
                    }

                    if(!isset($data['product_name'])){
                        $data['product_name'] = '';
                    }

                    if(!isset($data['amount'])){
                        $data['amount'] = '';
                    }

                    $data['hash'] = md5($data['store_inn'] . $data['account_inn'] . $data['product_name'] . $data['amount']);

                    $pdf = PDF::loadView('vendor.store_certificate_generatePDF', compact('data'));

                    $filename = $name . now()->second . '.pdf';

                    Storage::disk('public')->put($filename, $pdf->output());

                    $cFile = curl_file_create(public_path('storage/' . $filename), 'application/pdf');

                    $data_1 = [
                        'id' => $data['id'],
                        'assigned_user_id' => $data['assigned_user_id'],
                        'name' =>  $name,
                        'idField' =>  $data['idField'],
                        'moduleName' =>  $data['moduleName'],
                        'tableName' =>  $data['tableName'],
                        'fieldName' =>  $data['fieldName'],
                        'pdf'=> $cFile,
                    ];

                    $this->curlRequest($apiUrl, $data_1);

                    Storage::disk('public')->delete($filename);

                }
                if(isset($data['fieldName_2'])){
                    $name = $data['id'] . "_.pdf";
                    $data['url'] = "https://in.sklads.kg/storage/uploads/" . $name;

                    if(isset($data['store']['inn'])){
                        $data['store_inn'] = $data['store']['inn'];
                    }
                    else{
                        $data['store_inn'] = '';
                    }

                    if(isset($data['account']['inn'])){
                        $data['account_inn'] = $data['account']['inn'];
                    }
                    else{
                        $data['account_inn'] = '';
                    }

                    if(!isset($data['product_name'])){
                        $data['product_name'] = '';
                    }

                    if(!isset($data['amount'])){
                        $data['amount'] = '';
                    }

                    if(!isset($data['bank_select'])){
                        $data['bank_select']  = '';
                    }

                    $data['hash'] = md5($data['store_inn'] . $data['account_inn'] . $data['product_name'] . $data['amount'] . substr($data['bank_select'], 3));

                    $pdf = PDF::loadView('vendor.request_for_registration_to_bank_generatePDF', compact('data'));

                    $filename = $name . now()->second . '.pdf';

                    Storage::disk('public')->put($filename, $pdf->output());

                    $cFile = curl_file_create(public_path('storage/' . $filename), 'application/pdf');

                    $data_2 = [
                        'id' => $data['id'],
                        'assigned_user_id' => $data['assigned_user_id'],
                        'name' =>  $name,
                        'idField' =>  $data['idField'],
                        'moduleName' =>  $data['moduleName'],
                        'tableName' =>  $data['tableName'],
                        'fieldName' =>  $data['fieldName_2'],
                        'pdf' =>  $cFile,
                    ];

                    $this->curlRequest($apiUrl, $data_2);

                    Storage::disk('public')->delete($filename);
                }
            }
            if($data['moduleName'] == 'Store'){
                $name = $data['id'] . ".pdf";

                $data['url'] = "https://in.sklads.kg/storage/uploads/" . $name;

                if(isset($data['store']['inn'])){
                    $data['store_inn'] = $data['store']['inn'];
                }
                else{
                    $data['store_inn'] = '';
                }

                if(!isset($data['full_name'])){
                    $data['full_name'] = '';
                }

                $data['hash'] = md5($data['store_inn'] . $data['full_name'] . 1);
                $pdf = PDF::loadView('vendor.unclusion_in_the_register_generatePDF', compact('data'));

                $filename = $name . now()->second . '.pdf';

                Storage::disk('public')->put($filename, $pdf->output());

                $cFile = curl_file_create(public_path('storage/' . $filename), 'application/pdf');

                $data = [
                    'id' => $data['id'],
                    'assigned_user_id' => $data['assigned_user_id'],
                    'name' =>  $name,
                    'idField' =>  $data['idField'],
                    'moduleName' =>  $data['moduleName'],
                    'tableName' =>  $data['tableName'],
                    'fieldName' =>  $data['fieldName'],
                    'pdf' => $cFile,
                ];

                $this->curlRequest($apiUrl, $data);

                Storage::disk('public')->delete($filename);

            }
        }
        catch (\Exception $exception){
            //
        }
    }

    public function curlRequest($apiUrl, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);
    }

    public function generatePDF2(){
        $data['url'] = 'google.com';
        $pdf = PDF::loadView('vendor.store_certificate_generatePDF', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
