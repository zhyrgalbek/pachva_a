<?php


namespace App\VtigerAPIs;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

/**
 * Class ServiceApi
 * @package App\VtigerAPIs
 */
class ServiceInstanceApi
{

    /**
     * @param $service
     * @param $date_start
     * @param $date_end
     * @return array|Collection
     */
    public static function filterByDates($service,  $date_start, $date_end)
    {
        return self::GetData($service, $date_start, $date_end);
    }

    public static function AllByService($service)
    {
        return self::GetData($service);
    }

    public static function find($service_instance_id, $service)
    {
        return self::GetData($service)->where('id', $service_instance_id)->first();
    }

    /**
     * @param $service
     * @param null $date_start
     * @param null $date_end
     * @return array|Collection
     */
    private static function GetData($service, $date_start = null, $date_end = null)
    {
        try {
            $vtiger = config('vtiger');

            $client = new \GuzzleHttp\Client();
            $response = $client->post($vtiger['url'], [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Access-Key' => $vtiger['access_key']
                ],
                'form_params' => [
                        'username' => $vtiger['username'],
                        'operation' => 'GetData',
                        'service_id' => $service->id,
                        'date_from' => $date_start ?: date('Y-m-d', strtotime('today -7 day')),
                        'date_until' => $date_end ?: date('Y-m-d'),
                    ] + (auth()->check() ? [
                        'user_id' => auth()->user()->sbk_user_id
                    ] : [])
            ]);
        } catch (GuzzleException $exception) {
            abort(503);
        }
        if ($response->getStatusCode() != 200) {
            return [];
        }

        $detail = json_decode($response->getBody(), true);

        if (!$detail['success'] || !is_array($detail['result']))
            return [];

        $result = [];

        function setData(object $item, object $service, array $data)
        {
            foreach ($service->texts as $field => $label) {
                $item->texts[$field] = $data[$field];
            }
            foreach ($service->numbers as $field => $label) {
                $item->numbers[$field] = $data[$field];
            }
            foreach ($service->dates as $field => $label) {
                $item->dates[$field] = $data[$field];
            }
        }

        foreach ($detail['result'] as $data) {
            $item = (object)[
                'id' => $data['message_id'],
                'member_id' => $data['member_id'],
                'member_name' => $data['member_name'],
                'status' => $data['status'],
                'state' => $data['state'],
                'date_start' => $data['valid_from_date'],
                'date_end' => $data['valid_until_date'],
                'texts' => [],
                'numbers' => [],
                'dates' => [],
                'nested_data' => []
            ];

            setData($item, $service, $data);

            foreach ($service->nested_data as $i => $service_nested_data) {
                if (isset($data['nested_data'][$i])) {
                    $nested_data = $data['nested_data'][$i];
                    $nested_item = (object)[
                        'id' => $nested_data['id'],
                        'subject' => $nested_data['subject'],
                        'texts' => [],
                        'numbers' => [],
                        'dates' => [],
                    ];

                    setData($nested_item, $service_nested_data, $nested_data);

                    $item->nested_data[$i] = $nested_item;
                }
            }

            $result[] = $item;
        }

        return collect($result);
    }
}
