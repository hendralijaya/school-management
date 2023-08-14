<?php

namespace App\OpenApi\RequestBodies\API\v1\Diskon;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use App\OpenApi\Schemas\API\v1\Diskon\CreateDiskonSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateDiskonRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateDiskon')
            ->description('Data yang dibutuhkan untuk membuat diskon baru')
            ->content(
                MediaType::json()->schema(
                    CreateDiskonSchema::ref()
                )
            );
    }
}
