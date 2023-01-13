<?php


namespace App\VtigerAPIs;


use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;


class MemberApi
{
    public static function find($service_id, $member_id)
    {
        $member = self::getMember($service_id)->where('member_id', $member_id);
        if (is_null($member)) {
            throw new InvalidArgumentException('Member not found');
        }
        return $member[0];
    }

    private static function getMember($service_id)
    {
        $vtiger = config('vtiger');
        try {
            $client = new \GuzzleHttp\Client();
            $form_array = [
                'username' => $vtiger['username'],
                'operation' => 'GetMembers',
                'service_id' => $service_id,

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
            return collect($services['result']);
        } catch (GuzzleException $exception) {
            abort(503);
        }
    }
}