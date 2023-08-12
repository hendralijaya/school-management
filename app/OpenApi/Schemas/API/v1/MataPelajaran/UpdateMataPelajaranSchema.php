<?php

namespace App\OpenApi\Schemas\API\v1\MataPelajaran;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class UpdateMataPelajaranSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|SchemaReusable
     */
    public function build(): SchemaContract
    {
        return Schema::object('UpdateMataPelajaran')
            ->properties(
                Schema::string('nama')->required(),
                Schema::string('kategori')->required(),
                Schema::string('status')->required(),
            );
    }
}
