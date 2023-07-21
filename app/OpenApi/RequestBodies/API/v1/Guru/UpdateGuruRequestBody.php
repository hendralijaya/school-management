<?php

namespace App\OpenApi\RequestBodies\API\v1\Guru;

use App\OpenApi\Schemas\API\v1\Guru\UpdateGuruSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateGuruRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateGuru')
            ->description('Update Guru')
            ->content(
                MediaType::json()->schema(
                    UpdateGuruSchema::ref()
                )
            );
    }
}
