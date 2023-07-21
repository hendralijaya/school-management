<?php

namespace App\OpenApi\RequestBodies\API\v1\Siswa;

use App\OpenApi\Schemas\API\v1\Siswa\CreateSiswaSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateSiswaRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('SiswaCreate')
            ->description('Siswa create')
            ->content(
                MediaType::json()->schema(
                    CreateSiswaSchema::ref()
                )
            );
    }
}
