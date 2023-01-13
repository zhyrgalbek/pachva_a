<?php


namespace App\Services;


use Barryvdh\DomPDF\Facade as PDF;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Service
{
    /**
     * @param $tableName
     * @param $column
     * @return string
     */
    protected function generateUniqueCodeByDB($tableName, $column): string
    {
        do {
            $code = Str::random(15);
        } while ($this->hasInTable($code, $tableName, $column));
        return $code;
    }

    /**
     * @param $url_code
     * @return string
     */
    protected function createQRCode($url_code): string
    {
        try {
            $this->makeStorageDirectory('QRcodes');
            QrCode::size(500)
                ->format('png')
                ->generate(route('applications.showByQrcode', $url_code),
                    storage_path("app/public/QRcodes/$url_code.jpg"));
            return "QRcodes/$url_code.jpg";
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            abort(503);
        }
    }

    /**
     * @param $htmlView
     * @param bool[] $options
     * @return mixed
     */
    protected function generatePDFByView($htmlView, $options = ['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
    {
        $pdf = PDF::loadHTML($htmlView);
        $pdf->setOptions($options);
        return $pdf;
    }

    /**
     * @param string $directory
     * @return void
     */
    private function makeStorageDirectory(string $directory): void
    {
        if (!Storage::exists('public/' . $directory)) {
            try {
                Storage::makeDirectory('public/' . $directory);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
                abort(503);
            }
        }
    }

    /**
     * @param $value
     * @param $tableName
     * @param $column
     * @return bool
     */
    private function hasInTable($value, $tableName, $column): bool
    {
        try {
            return DB::table($tableName)->where($column, $value)->exists();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            abort(503);
        }
    }
    protected function isDate($value): bool
    {
        if (!$value) {
            return false;
        }

        try {
            new \DateTime($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
