<?php

namespace App\OpenApi\Schemas\API\v1\Guru;

use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;

class UpdateGuruSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('UpdateGuru')
            ->properties(
                Schema::string('nama')->required(),
                Schema::string('no_wa')->required(),
                Schema::string('gender')->required(),
                Schema::string('tgl_bergabung')->required()->format(Schema::FORMAT_DATE),
                Schema::string('tgl_lahir')->required()->format(Schema::FORMAT_DATE),
                Schema::string('alamat')->required(),
                Schema::string('status')->required()->enum('A', 'D'),
            );
    }
}
