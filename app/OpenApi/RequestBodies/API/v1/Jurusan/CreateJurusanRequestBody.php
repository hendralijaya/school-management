<?php

namespace App\OpenApi\RequestBodies\API\v1\Jurusan;

use App\OpenApi\Schemas\API\v1\Jurusan\CreateJurusanSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateJurusanRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateJurusan')->description('Create Jurusan')
            ->content(
                MediaType::json()->schema(
                    CreateJurusanSchema::ref()
                )
            );
    }
}
