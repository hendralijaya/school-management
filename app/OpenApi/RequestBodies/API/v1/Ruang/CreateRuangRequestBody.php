<?php

namespace App\OpenApi\RequestBodies\API\v1\Ruang;

use App\Models\Ruang;
use App\OpenApi\Schemas\API\v1\Ruang\CreateRuangSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateRuangRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateRuang')
            ->description('Ruang object that needs to be added to the database')
            ->content(
                MediaType::json()->schema(
                    CreateRuangSchema::ref()
                )
            );
    }
}
