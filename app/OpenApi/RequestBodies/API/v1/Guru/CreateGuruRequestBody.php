<?php

namespace App\OpenApi\RequestBodies\API\v1\Guru;

use App\OpenApi\Schemas\API\v1\Guru\CreateGuruSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateGuruRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateGuru')
            ->description('Create Guru')
            ->content(
                MediaType::json()->schema(
                    CreateGuruSchema::ref()
                )
            );
    }
}
