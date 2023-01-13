<?php


namespace App\Helpers;

use App\Models\LogActivity as LogActivityModel;

class LogActivity
{
    private static $expected_params = ['password', 'password_confirmation'];

    public static function addToLog()
    {
        if (env('APP_DEBUG', true) || request()->method() == 'GET') {
            return;                                 //If is debug version
        }
        $log = [];
        $log['url'] = request()->fullUrl();
        $log['method'] = request()->method();
        $log['ip'] = request()->ip();
        $log['body'] = request()->except(self::$expected_params);
        $log['agent'] = request()->header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : null;
        LogActivityModel::create($log);
    }
}
