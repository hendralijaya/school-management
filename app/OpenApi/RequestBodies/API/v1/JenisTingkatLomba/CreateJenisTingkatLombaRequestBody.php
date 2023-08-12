<?php

namespace App\OpenApi\RequestBodies\API\v1\JenisTingkatLomba;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\JenisTingkatLomba\CreateJenisTingkatLombaSchema;

class CreateJenisTingkatLombaRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create("CreateJenisTingkatLomba")
            ->description("Create Jenis Tingkat Lomba")
            ->content(
                MediaType::json()->schema(
                    CreateJenisTingkatLombaSchema::ref()
                )
            );
    }
}
