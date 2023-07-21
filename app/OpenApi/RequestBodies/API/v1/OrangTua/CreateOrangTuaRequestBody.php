<?php

namespace App\OpenApi\RequestBodies\API\v1\OrangTua;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\OrangTua\CreateOrangTuaSchema;

class CreateOrangTuaRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateOrangTua')
            ->description('Create Orang Tua')
            ->content(
                MediaType::json()->schema(
                    CreateOrangTuaSchema::ref()
                )
            );
    }
}
