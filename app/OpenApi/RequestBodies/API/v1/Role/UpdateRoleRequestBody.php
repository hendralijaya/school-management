<?php

namespace App\OpenApi\RequestBodies\API\v1\Role;

use App\OpenApi\Schemas\API\v1\Role\UpdateRoleSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateRoleRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('RoleUpdate')
            ->description('Role update')
            ->content(
                MediaType::json()->schema(
                    UpdateRoleSchema::ref()
                )
            );
    }
}
