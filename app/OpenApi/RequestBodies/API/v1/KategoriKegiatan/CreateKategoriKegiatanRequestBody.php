<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriKegiatan;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriKegiatan\CreateKategoriKegiatanSchema;

class CreateKategoriKegiatanRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateKategoriKegiatan')
            ->description('Data untuk membuat kategori kegiatan baru')
            ->content(
                MediaType::json()->schema(
                    CreateKategoriKegiatanSchema::ref()
                )
            );
    }
}
