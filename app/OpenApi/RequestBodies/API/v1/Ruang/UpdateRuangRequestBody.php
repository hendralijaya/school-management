<?php

namespace App\OpenApi\RequestBodies\API\v1\Ruang;

use App\OpenApi\Schemas\API\v1\Ruang\UpdateRuangSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateRuangRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateRuang')
            ->description('Ruang object that needs to be updated to the database')
            ->content(
                MediaType::json()->schema(
                    UpdateRuangSchema::ref()
                )
            );
    }
}
