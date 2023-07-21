<?php

namespace App\OpenApi\RequestBodies\API\v1\MataPelajaran;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\MataPelajaran\CreateMataPelajaranSchema;

class CreateMataPelajaranRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateMataPelajaran')
            ->description('Create Mata Pelajaran')
            ->content(
                MediaType::json()->schema(
                    CreateMataPelajaranSchema::ref()
                )
            );
    }
}
