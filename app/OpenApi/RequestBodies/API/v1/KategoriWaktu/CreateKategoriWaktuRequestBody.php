<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriWaktu;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriWaktu\CreateKategoriWaktuSchema;

class CreateKategoriWaktuRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        // Bahasa Indonesia: Data yang digunakan untuk membuat kategori waktu baru
        return RequestBody::create('CreateKategoriWaktu')
            ->description('Data yang digunakan untuk membuat kategori waktu baru')
            ->content(
                MediaType::json()->schema(
                    CreateKategoriWaktuSchema::ref()
                )
            );
    }
}
