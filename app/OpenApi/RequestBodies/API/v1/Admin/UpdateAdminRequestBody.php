<?php

namespace App\OpenApi\RequestBodies\API\v1\Admin;

use App\OpenApi\Schemas\API\v1\Admin\UpdateAdminSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateAdminRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UpdateAdmin')
            ->description('Update Admin')
            ->content(
                MediaType::json()->schema(
                    UpdateAdminSchema::ref()
                )
            );
    }
}
