<?php

namespace App\OpenApi\RequestBodies\API\v1\Kurikulum;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\Kurikulum\CreateKurikulumSchema;

class CreateKurikulumRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateKurikulum')
            ->description('Data yang digunakan untuk membuat kurikulum baru')
            ->content(
                MediaType::json()->schema(
                    CreateKurikulumSchema::ref()
                )
            );
    }
}
