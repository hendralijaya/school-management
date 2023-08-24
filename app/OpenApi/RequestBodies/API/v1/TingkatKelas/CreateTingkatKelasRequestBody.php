<?php

namespace App\OpenApi\RequestBodies\API\v1\TingkatKelas;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\TingkatKelas\CreateTingkatKelasSchema;

class CreateTingkatKelasRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateTingkatKelas')
            ->description('Create Tingkat Kelas')
            ->content(
                MediaType::json()->schema(
                    CreateTingkatKelasSchema::ref()
                )
            );
    }
}
