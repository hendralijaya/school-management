<?php

namespace App\OpenApi\RequestBodies\API\v1\Diskon;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use App\OpenApi\Schemas\API\v1\Diskon\UpdateDiskonSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateDiskonRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateDiskon')
            ->description('Data yang dibutuhkan untuk mengubah diskon')
            ->content(
                MediaType::json()->schema(
                    UpdateDiskonSchema::ref()
                )
            );
    }
}
