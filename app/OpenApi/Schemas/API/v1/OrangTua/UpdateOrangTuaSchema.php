<?php

namespace App\OpenApi\Schemas\API\v1\OrangTua;

use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;

class UpdateOrangTuaSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('UpdateOrangTua')
            ->properties(
                Schema::string('nama')->required(),
                Schema::string('no_wa')->required(),
                Schema::string('gender')->required(),
                Schema::string('tgl_lahir')->required(),
                Schema::string('alamat')->required(),
                Schema::string('status')->required()->enum('A', 'D')
            );
    }
}
