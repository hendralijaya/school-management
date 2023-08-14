<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriWaktu;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriWaktu\UpdateKategoriWaktuSchema;

class UpdateKategoriWaktuRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateKategoriWaktu')
            ->description('Data yang digunakan untuk mengubah kategori waktu')
            ->content(
                MediaType::json()->schema(
                    UpdateKategoriWaktuSchema::ref()
                )
            );
    }
}
