<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriHari;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriHari\CreateKategoriHariSchema;

class CreateKategoriHariRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create("CreateKategoriHariRequestBody")
            ->description("CreateKategoriHariRequestBody description")
            ->content(
                MediaType::json()->schema(
                    CreateKategoriHariSchema::ref()
                )
            );
    }
}
