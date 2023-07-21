<?php

namespace App\OpenApi\RequestBodies\API\v1\Siswa;

use App\OpenApi\Schemas\API\v1\Siswa\UpdateSiswaSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateSiswaRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('SiswaUpdate')
            ->description('Siswa update')
            ->content(
                MediaType::json()->schema(
                    UpdateSiswaSchema::ref()
                )
            );
    }
}
