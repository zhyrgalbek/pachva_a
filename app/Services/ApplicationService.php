<?php


namespace App\Services;


use App\Models\Application;
use App\VtigerAPIs\ApplicationApi;
use App\VtigerAPIs\MemberApi;
use App\VtigerAPIs\ServiceApi;

class ApplicationService extends Service
{
    public function create($service_id): array
    {
        try {
            $service = ServiceApi::find($service_id);
            $translatedService = self::translateService($service);
        } catch (\Exception $ex) {
            return [
                'status' => 'success',
                'data' => null,
                'error' => $ex->getMessage(),
            ];
        }

        return [
            'status' => 'success',
            'data' => $translatedService,
            'error' => null,
        ];
    }

    public function showByCode($application)
    {
        $user = auth()->check() ? auth()->user() : null;
        $isOwner = !is_null($user) && $user->id == $application->user->id;
        $sender = [];
        $recipient = [];
        $sender['identifier'] = $isOwner ? $user->identifier : $this->hidePartStr(3, 8, $application->user->identifier);
        $sender['name'] = $isOwner ? $user->full_name : $application->user->last_name;
        $recipient['identifier'] = $isOwner ? $application->member_identifier :
            $this->hidePartStr(3, 8, $application->member_identifier);

        $recipient['name'] = $application->member_name;

        $sentFields = $this->parseDataForGeneratePdf($isOwner, $application->sent_data, $application->details_data);
        $serviceName = $application->service_name;
        $path_to_qrcode = $application->path_to_QR;
        return $this->generatePDFByView(
            view('templates.applicationPdf',
                compact('sender',
                    'path_to_qrcode',
                    'recipient',
                    'sentFields',
                    'serviceName')));
    }

    private function parseDataForGeneratePdf($isOwner, $sentData, $details): array
    {
        $result = [];
        foreach (json_decode($sentData) as $key => $datum) {
            $result[$key] = $isOwner ?
                $datum :
                $this->hidePartStr(
                    round((strlen($datum)) / 2, 0, PHP_ROUND_HALF_DOWN),
                    strlen($datum),
                    $datum
                );
        }
        foreach (json_decode($details) as $key => $datum) {
            $result[$key] = $isOwner ?
                $datum :
                $this->hidePartStr(
                    round((strlen($datum)) / 2, 0, PHP_ROUND_HALF_DOWN),
                    strlen($datum),
                    $datum
                );
        }
        return $result;
    }

    private function hidePartStr($start, $length, $str)
    {
        $oldStr = mb_substr($str, $start, $length);
        $replacement = str_repeat('*', strlen($oldStr));
        return str_replace($oldStr, $replacement, $str);
    }

    /**
     * @param $data
     * @return array
     */
    public
    function store($data): array
    {
        $localDBData = $this->parseForLocalDB($data);
        $remoteDBData = $this->setForRemoteDB($data);
        try {
            $application_id = ApplicationApi::create($remoteDBData);
            $member = MemberApi::find($data['service_id'], $data['member_id']);

            Application::create([
                'user_id' => auth()->user()->id,
                'service_name' => $data['service_name'],
                'sent_data' => json_encode($localDBData['send_data']),
                'details_data' => json_encode($localDBData['details']),
                'member_id' => $member['member_id'],
                'application_sbk_id' => $application_id,
                'member_name' => $member['member_name'],
                'member_identifier' => $member['inn'],

            ]);
        } catch (\Exception $ex) {
            return [
                'status' => 'failed',
                'data' => null,
                'error' => $ex->getMessage(),
            ];
        }
        return [
            'status' => 'success',
            'data' => $application_id,
            'error' => null,
        ];

    }

    private function setForRemoteDB($data)
    {
        foreach ($data['data'] as $key => $datum) {
            $data['data'][$key] = $datum[0];
        }
        if (array_key_exists('details', $data)) {
            foreach ($data['details'] as $key => $detail) {
                foreach ($detail as $detail_key => $item) {
                    $data['details'][$key][$detail_key] = $item[0];
                }
            }
        }
        return $data;
    }

    private function parseForLocalDB($data): array
    {
        $for_local_DB_data = self::concatNameWithValue($data['data']);
        $nested_data = [];
        if (array_key_exists('details', $data)) {
            foreach ($data['details'] as $detail) {
                $nested_data += self::concatNameWithValue($detail);
            }
        }
        foreach ($for_local_DB_data as $key => $field) {
            if ($this->isDate($field)) {
                $for_local_DB_data[$key] = date('d-m-Y h:i', strtotime($field));
            }
        }
        foreach ($nested_data as $key => $field) {
            if ($this->isDate($field)) {
                $nested_data[$key] = date('d-m-Y h:i', strtotime($field));
            }
        }
        return ['send_data' => $for_local_DB_data, 'details' => $nested_data];
    }

    private static function concatNameWithValue($data): array
    {
        $result_array = [];
        foreach ($data as $datum) {
            $result_array[$datum[1]] = $datum[0];
        }
        return $result_array;
    }

    /**
     * @return mixed
     */
    public
    function getUserApplications()
    {
        $vtApplications = ApplicationApi::allByUser(auth()->user()->sbk_user_id);
        $applications = Application::where('user_id', auth()->user()->id)->latest()->paginate(10);
        foreach ($applications as $application) {
            if ($application->status_str == 'sent') {
                $application = $this->updateStatus($vtApplications, $application);
            }
        }
        return $applications;
    }

    /**
     * @param $service
     * @return mixed
     */
    private static function translateService($service)
    {
        $langKey = 1;
        if (app()->getLocale() == 'kg') {
            $langKey = 2;
        } else if (app()->getLocale() == 'en') {
            $langKey = 3;
        }
        $numberLangKey = [0, 1];
        if ($langKey == 2) {
            $numberLangKey = [2, 3];
        } else if ($langKey == 3) {
            $numberLangKey = [4, 5];
        }


        $localizationArray = [];
        for ($i = $langKey; array_key_exists('text_' . $i, $service->texts); $i = $i + 3) {
            $localizationArray['text_' . $i] = $service->texts['text_' . $i];
        }
        $service->texts = $localizationArray;

        foreach ($service->numbers as $key => $number) {
            $temp_array = [];
            $temp_array[] = $service->numbers[$key][$numberLangKey[0]];
            $temp_array[] = $service->numbers[$key][$numberLangKey[1]];
            $service->numbers[$key] = $temp_array;
        }
        foreach ($service->dates as $key => $date) {
            $temp_array = [];
            $temp_array[] = $service->dates[$key][$numberLangKey[0]];
            $temp_array[] = $service->dates[$key][$numberLangKey[1]];
            $service->dates[$key] = $temp_array;
        }
        if (isset($service->nested_data)) {
            $newNestedData = [];
            foreach ($service->nested_data as $data) {
                $localizationArray = [];
                for ($i = $langKey; array_key_exists('text_' . $i, $data->texts); $i = $i + 3) {
                    $localizationArray['text_' . $i] = $data->texts['text_' . $i];
                }
                $data->texts = $localizationArray;
                foreach ($data->numbers as $key => $number) {
                    $temp_array = [];
                    $temp_array[] = $data->numbers[$key][$numberLangKey[0]];
                    $temp_array[] = $data->numbers[$key][$numberLangKey[1]];
                    $data->numbers[$key] = $temp_array;
                }
                foreach ($data->dates as $key => $date) {
                    $temp_array = [];
                    $temp_array[] = $data->dates[$key][$numberLangKey[0]];
                    $temp_array[] = $data->dates[$key][$numberLangKey[1]];
                    $data->dates[$key] = $temp_array;
                }
                $newNestedData[] = $data;
            }
            $service->nested_data = $newNestedData;
        }
        return $service;
    }

    /**
     * @param $vtApplications
     * @param $application
     * @return mixed
     */
    private
    function updateStatus($vtApplications, $application)
    {
        $currentVtApplication = $vtApplications->where('message_id', $application);
//            TODO: rewrite when you get response field name on request
        if (/*has answer*/ rand(1, 1)) {
            if (/*approved or reject*/ rand(1, 1)) {
                $application->status_str = 'approved';
                $application->code = $this->generateUniqueCodeByDB('applications', 'code');
                $application->path_to_QR = $this->createQRCode($application->code);
            } else {
                $application->status_str = 'rejected';
            }
            $application->save();
        } elseif (strtotime($currentVtApplication) && strtotime($currentVtApplication) < now()) {
            $application->status = 'canceled';
            $application->save();
        }
        return $application;
    }
}
