<?php

namespace App\OpenApi\RequestBodies\API\v1\Kurikulum;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\Kurikulum\UpdateKurikulumSchema;

class UpdateKurikulumRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateKurikulum')
            ->description('Data yang digunakan untuk mengubah kurikulum')
            ->content(
                MediaType::json()->schema(
                    UpdateKurikulumSchema::ref()
                )
            );
    }
}
