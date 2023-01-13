<?php


namespace App\VtigerAPIs;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

/**
 * Class ServiceApi
 * @package App\VtigerAPIs
 */
class ApplicationApi
{
    /**
     */
    public static function create($data): ?string
    {
        $response = self::pushData($data['service_name'],
            $data['service_id'], $data['member_id'], $data['data'],
            $data['details'] ?? null);
        return $response;
    }

    public static function allByUser($user_sbk_id): Collection
    {
        return collect(self::getApplicationsBySbkId($user_sbk_id));
    }

    /**
     * @param $serviceName
     * @param $serviceId
     * @param $fields
     * @param $nestedFields
     * @param $member_id
     * @return string
     */
    private static function pushData($serviceName, $serviceId, $member_id, $fields, $nestedFields = null): ?string
    {
        //TODO: remove Stub
        return mt_rand(1000000, 9999999);
        $vtiger = config('vtiger');
        try {
            $client = new \GuzzleHttp\Client();
            $form_array = [
                'username' => $vtiger['username'],
                'operation' => 'PushData',
                'service_id' => $serviceId,
                'userid' => 354,
                'member_id' => $member_id,
                'valid_from_date' => date('Y-m-d H:i:s'),
                'valid_until_date' => date('Y-m-d H:i:s', strtotime("+500000 sec")),
                'reply_to' => null,
                'data' => json_encode($fields),
                'details' => $nestedFields ? json_encode($nestedFields) : null,
                'subject' => $serviceName . ' ' . (auth()->check() ? auth()->user()->last_name : null),
                'contact_id' => auth()->check() ? auth()->user()->sbk_user_id : null,
            ];
            $response = $client->post($vtiger['url'], [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Access-Key' => $vtiger['access_key']
                ],
                'form_params' => $form_array,
                'connect_timeout' => 15,
                'timeout' => 30
            ]);
            if ($response->getStatusCode() != 200) {
                abort(503);
            }

            $services = json_decode($response->getBody(), true);
            if (!$services['success']) {
                abort(503);
            }
            return $services['result'];
        } catch (GuzzleException $exception) {
            abort(503);
        }
    }

    private static function getApplicationsBySbkId($user_sbk_id)
    {
        $vtiger = config('vtiger');
        try {
            $client = new \GuzzleHttp\Client();
            $form_array = [
                'username' => $vtiger['username'],
                'operation' => 'GetRequest',
                'contact_id' => $user_sbk_id,

            ];
            $response = $client->post($vtiger['url'], [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Access-Key' => $vtiger['access_key']
                ],
                'form_params' => $form_array,
                'connect_timeout' => 15,
                'timeout' => 30
            ]);
            if ($response->getStatusCode() != 200) {
                abort(503);
            }

            $response = json_decode($response->getBody(), true);

            if (!$response['success']) {
                abort(503);
            }
            return $response['result'];
        } catch (GuzzleException $exception) {
            abort(503);
        }
    }
}

