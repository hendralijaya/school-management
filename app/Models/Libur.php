<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libur extends Model
{
    protected $table = 'libur';
    protected $fillable = ['kategori_hari_id', 'nama_hari_raya', 'tanggal_mulai', 'tanggal_selesai'];

    private $apiKey;



    public $timestamps = false;
    use HasFactory;

    private static function getUrl($dateMin, $dateMax)
    {
        $apiKey = env('GOOGLE_API_KEY');
        return "https://www.googleapis.com/calendar/v3/calendars/id.indonesian%23holiday%40group.v.calendar.google.com/events?key={$apiKey}&timeMin={$dateMin}T00:00:00Z&timeMax={$dateMax}T23:59:59Z";
    }

    public static function getHolidaysFromGoogleCalendarApi($dateMin, $dateMax, $summaryFilters = [])
    {
        $url = self::getUrl($dateMin, $dateMax);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);

        $response = json_decode($response, true);

        $holidays = [];
        if (isset($response['items'])) {
            foreach ($response['items'] as $item) {
                $summary = $item['summary'];
                $startDate = $item['start']['date'];

                if (!empty($summaryFilters)) {
                    foreach ($summaryFilters as $filter) {
                        if (strpos($summary, $filter) !== false) {
                            continue 2;
                        }
                    }
                }

                $holidays[] = [
                    'nama_hari_raya' => $summary,
                    'tanggal_mulai' => $startDate,
                    'tanggal_selesai' => $startDate,
                ];
            }
        }

        return $holidays;
    }
}
