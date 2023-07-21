<?php

namespace App\OpenApi\Schemas\API\v1\Ruang;

use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;

class CreateRuangSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('CreateRuang')
            ->properties(
                Schema::string('nama')->example('Ruang 1'),
                Schema::integer('kapasitas')->example(20),
                Schema::string('status')->example('A'),
            );
    }
}
