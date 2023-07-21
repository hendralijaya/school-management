<?php

namespace App\OpenApi\RequestBodies\API\v1\Auth;

use App\Http\Requests\API\v1\Auth\RegisterRequest;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class RegisterRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(
            MediaType::json()->schema(
                RegisterRequest::ref()
            )
        );
    }
}
