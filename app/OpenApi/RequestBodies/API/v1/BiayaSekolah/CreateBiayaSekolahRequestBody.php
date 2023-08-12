<?php

namespace App\OpenApi\RequestBodies\API\v1\BiayaSekolah;

use App\OpenApi\Schemas\API\v1\BiayaSekolah\CreateBiayaSekolahSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateBiayaSekolahRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateBiayaSekolah')
            ->description('Biaya Sekolah')
            ->content(
                MediaType::json()->schema(
                    CreateBiayaSekolahSchema::ref()
                )
            );
    }
}
