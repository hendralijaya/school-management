<?php

namespace App\OpenApi\RequestBodies\API\v1\Jurusan;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use App\OpenApi\Schemas\API\v1\Jurusan\UpdateJurusanSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateJurusanRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateJurusan')
            ->description('Update Jurusan')
            ->content(
                MediaType::json()->schema(
                    UpdateJurusanSchema::ref()
                )
            );
    }
}
