<?php


namespace App\VtigerAPIs;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

/**
 * Class ServiceApi
 * @package App\VtigerAPIs
 */
class ServiceApi
{
    /**
     * @return array|Collection
     */
    public static function all()
    {
        return self::GetServices();
    }

    /**
     * @param $service_id
     * @return Collection
     */
    public static function find($service_id)
    {
        return self::GetServices()->where('id', $service_id)->first();
    }

    /**
     * @param $role_type
     * @return array|Collection
     */
    public static function FilterByRoleType($role_type)
    {
        return self::GetServices($role_type);
    }

    /**
     * @param null $role_type
     * @return array|Collection
     */
    private static function GetServices($role_type = null)
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
                    'operation' => 'GetServices',
                    'role_type' => $role_type,
                    'user_id' => auth()->check() ? auth()->user()->sbk_user_id : null,
                ],
                'connect_timeout' => 15,
                'timeout' => 30
            ]);
        } catch (GuzzleException $exception) {
            abort(503);
        }

        if ($response->getStatusCode() != 200) {
            return [];
        }

        $services = json_decode($response->getBody(), true);
        if (!$services['success']) {
            return [];
        }
        foreach ($services['result'] as $service) {
            $item = (object)[
                'id' => $service['service_id'],
                'name' => $service['service_name'],
                'type' => $service['type'],
                'category' => $service['category'],
                'kind' => $service['kind'],
                'subkind' => $service['subkind'],
                'description' => $service['description'],
                'icon' => $service['icon_name'], // 'fas fa-archive',
                'date_start' => $service['valid_from_date'],
                'date_end' => $service['valid_until_date'],
                'texts' => [],
                'numbers' => [],
                'dates' => [],
                'nested_data' => [],
            ];
            //parse texts
            for ($i = 1; array_key_exists('text_' . $i, $service); $i++) {
                if ($service['text_' . $i]) {
                    $item->texts['text_' . $i] = self::parseText($service['text_' . $i]);
                }
            }
            //parse numbers
            for ($i = 1; array_key_exists('number_' . $i, $service); $i++) {
                if ($service['number_' . $i]) {
                    $item->numbers['number_' . $i] = self::parseNumberOrDate($service['number_' . $i]);
                }
            }
            //parse dates
            for ($i = 1; array_key_exists('date_' . $i, $service); $i++) {
                if ($service['date_' . $i]) {
                    $item->dates['date_' . $i] = self::parseNumberOrDate($service['date_' . $i]);
                }
            }
            //parse nested data
            if (isset($service['nested_data'])) {
                foreach ($service['nested_data'] as $data) {
                    $nested_item = (object)[
                        'id' => $data['id'],
                        'subject' => $data['subject'],
                        'texts' => [],
                        'numbers' => [],
                        'dates' => [],
                    ];
                    for ($i = 1; array_key_exists('text_' . $i, $data); $i++) {
                        if ($data['text_' . $i]) {
                            $nested_item->texts['text_' . $i] = self::parseText($data['text_' . $i]);
                        }
                    }
                    for ($i = 1; array_key_exists('number_' . $i, $data); $i++) {
                        if ($data['number_' . $i]) {
                            $nested_item->numbers['number_' . $i] = self::parseNumberOrDate($data['number_' . $i]);
                        }
                    }
                    for ($i = 1; array_key_exists('date_' . $i, $data); $i++) {
                        if ($data['date_' . $i]) {
                            $nested_item->dates['date_' . $i] = self::parseNumberOrDate($data['date_' . $i]);
                        }
                    }
                    $item->nested_data[] = $nested_item;
                }
            }
            $result[] = $item;
        }
        return collect($result);
    }
    /**
     * @param $text
     * @return array
     */
    private static function parseText($text)
    {
        return [
            preg_replace('/\n.+/', '', $text),
            preg_replace('/.+\n/', '', $text),
        ];
    }

    /**
     * @param $text
     * @return array
     */
    private static function parseNumberOrDate($text): array
    {
        if ($text == "") {
            return [];
        }
        $localizations = ['ru', 'kg', 'en'];
        $matches = [];
        $result_array = [];
        foreach ($localizations as $localization) {
            if (preg_match(
                '/' . $localization . ': ([\S\s]+?)(\n[a-z]{2}:|$)/ui',
                $text,
                $matches)) {

                $result_array[] = preg_replace('/\n.+/', '', $matches[1]);
                $result_array[] = preg_replace('/.+\n/', '', $matches[1]);
            } else {
                $result_array[] = $text;
                $result_array[] = $text;
            }
        }
        return $result_array;
    }
}
