<?php

namespace App\OpenApi\RequestBodies\API\v1\JabatanGuru;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\JabatanGuru\UpdateJabatanGuruSchema;

class UpdateJabatanGuruRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateJabatanGuru')
            ->description('Update Jabatan Guru')
            ->content(
                MediaType::json()->schema(
                    UpdateJabatanGuruSchema::ref()
                )
            );
    }
}
