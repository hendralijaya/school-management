<?php

namespace App\OpenApi\Parameters\API\v1\OrangTua;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListOrangTuaParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('gender')
                ->description('Filter by gender')
                ->schema(Schema::string()->enum(['M', 'F']))
                ->required(false),
            Parameter::query()
                ->name('status')
                ->description('Filter by status')
                ->schema(Schema::string()->enum(['A', 'D']))
                ->required(false),
            Parameter::query()
                ->name('search')
                ->description('Search by keyword')
                ->schema(Schema::string())
                ->required(false),
        ];
    }
}