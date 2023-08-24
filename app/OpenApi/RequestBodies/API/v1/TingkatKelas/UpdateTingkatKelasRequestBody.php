<?php

namespace App\OpenApi\RequestBodies\API\v1\TingkatKelas;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\TingkatKelas\UpdateTingkatKelasSchema;

class UpdateTingkatKelasRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateTingkatKelas')
            ->description('Update Tingkat Kelas')
            ->content(
                MediaType::json()->schema(
                    UpdateTingkatKelasSchema::ref()
                )
            );
    }
}
