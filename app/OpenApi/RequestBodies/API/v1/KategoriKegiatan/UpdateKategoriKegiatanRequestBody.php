<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriKegiatan;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriKegiatan\UpdateKategoriKegiatanSchema;

class UpdateKategoriKegiatanRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateKategoriKegiatan')
            ->description('Data untuk mengubah kategori kegiatan')
            ->content(
                MediaType::json()->schema(
                    UpdateKategoriKegiatanSchema::ref()
                )
            );
    }
}
