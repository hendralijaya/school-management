<?php

namespace App\OpenApi\Parameters\API\v1\User;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListUserParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [
            Parameter::query()
                ->name('per_page')
                ->description('Limit the number of jenis tingkat lomba data returned')
                ->schema(Schema::integer()->default(10))
                ->required(false),
            Parameter::query()
                ->name('role_id')
                ->description('Filter by role id')
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('status')
                ->description('Filter by status')
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('search')
                ->description('Search by email')
                ->schema(Schema::string()),
        ];
    }
}
