<?php

namespace App\OpenApi\RequestBodies\API\v1\JenisTingkatLomba;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use App\OpenApi\Schemas\API\v1\JenisTingkatLomba\UpdateJenisTingkatLombaSchema;

class UpdateJenisTingkatLombaRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create("UpdateJenisTingkatLomba")
            ->description("Update Jenis Tingkat Lomba")
            ->content(
                MediaType::json()->schema(
                    UpdateJenisTingkatLombaSchema::ref()
                )
            );
    }
}
