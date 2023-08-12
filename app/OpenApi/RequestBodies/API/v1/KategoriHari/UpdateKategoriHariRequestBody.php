<?php

namespace App\OpenApi\RequestBodies\API\v1\KategoriHari;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\KategoriHari\UpdateKategoriHariSchema;

class UpdateKategoriHariRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create("UpdateKategoriHariRequestBody")
            ->description("UpdateKategoriHariRequestBody description")
            ->content(
                MediaType::json()->schema(
                    UpdateKategoriHariSchema::ref()
                )
            );
    }
}
