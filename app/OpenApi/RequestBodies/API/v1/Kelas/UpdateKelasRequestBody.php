<?php

namespace App\OpenApi\RequestBodies\API\v1\Kelas;

use App\OpenApi\Schemas\API\v1\Kelas\UpdateKelasSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateKelasRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateKelasRequestBody')
            ->description('Update Kelas Request Body')
            ->content(
                MediaType::json()->schema(
                    UpdateKelasSchema::ref()
                )
            );
    }
}
