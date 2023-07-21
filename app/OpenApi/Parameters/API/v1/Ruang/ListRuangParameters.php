<?php

namespace App\OpenApi\Parameters\API\v1\Ruang;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListRuangParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [
            Parameter::query()
                ->name('status')
                ->description('Filter by status')
                ->schema(Schema::string()->enum(['A', 'D']))
                ->required(false),
            Parameter::query()
                ->name('capacity_from && capacity_to')
                ->description('Filter By Capacity')
                ->schema(Schema::string()->default('20&&30'))
                ->required(false),
            Parameter::query()
                ->name('search')
                ->description('Search by keyword')
                ->schema(Schema::string())
                ->required(false),
        ];
    }
}
