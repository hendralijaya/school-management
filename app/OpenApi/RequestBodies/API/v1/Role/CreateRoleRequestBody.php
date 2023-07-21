<?php

namespace App\OpenApi\RequestBodies\API\v1\Role;

use App\OpenApi\Schemas\API\v1\Role\CreateRoleSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateRoleRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('RoleCreate')
            ->description('Role create')
            ->content(
                MediaType::json()->schema(
                    CreateRoleSchema::ref()
                )
            );
    }
}
