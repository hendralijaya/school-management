<?php

namespace App\OpenApi\RequestBodies\API\v1\JabatanGuru;

use App\OpenApi\Schemas\API\v1\JabatanGuru\CreateJabatanGuruSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateJabatanGuruRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateJabatanGuru')
            ->description('Create Jabatan Guru')
            ->content(
                MediaType::json()->schema(
                    CreateJabatanGuruSchema::ref()
                )
            );
    }
}
