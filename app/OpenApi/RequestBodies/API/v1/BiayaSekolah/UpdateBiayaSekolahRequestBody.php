<?php

namespace App\OpenApi\RequestBodies\API\v1\BiayaSekolah;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\BiayaSekolah\UpdateBiayaSekolahSchema;

class UpdateBiayaSekolahRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateBiayaSekolah')
            ->description('Data yang dibutuhkan untuk mengubah biaya sekolah')
            ->content(
                MediaType::json()->schema(
                    UpdateBiayaSekolahSchema::ref()
                )
            );
    }
}
