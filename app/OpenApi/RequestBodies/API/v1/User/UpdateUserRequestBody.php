<?php

namespace App\OpenApi\RequestBodies\API\v1\User;

use App\OpenApi\Schemas\API\v1\User\UpdateUserSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UserUpdate')
            ->description('User update')
            ->content(
                MediaType::json()->schema(
                    UpdateUserSchema::ref()
                )
            );
    }
}
