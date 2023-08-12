<?php

namespace App\OpenApi\RequestBodies\API\v1\Admin;

use App\OpenApi\Schemas\API\v1\Admin\CreateAdminSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateAdminRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateAdmin')
            ->description('Create Admin')
            ->content(
                MediaType::json()->schema(
                    CreateAdminSchema::ref()
                )
            );
    }
}
