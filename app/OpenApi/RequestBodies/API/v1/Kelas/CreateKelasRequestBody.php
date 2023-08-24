<?php

namespace App\OpenApi\RequestBodies\API\v1\Kelas;

use App\Http\Requests\API\v1\Kelas\CreateKelasRequest;
use App\OpenApi\Schemas\API\v1\Kelas\CreateKelasSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateKelasRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateKelasRequestBody')
            ->description('Create Kelas Request Body')
            ->content(
                MediaType::json()->schema(
                    CreateKelasSchema::ref()
                )
            );
    }
}
