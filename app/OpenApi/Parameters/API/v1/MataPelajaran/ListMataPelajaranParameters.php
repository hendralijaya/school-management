<?php

namespace App\OpenApi\Parameters\API\v1\MataPelajaran;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListMataPelajaranParameters extends ParametersFactory
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
                ->name('kategori')
                ->description('Filter by kategori')
                ->schema(Schema::string()->default('Umum'))
                ->required(false),
            Parameter::query()
                ->name('search')
                ->description('Search by keyword')
                ->schema(Schema::string())
                ->required(false),

        ];
    }
}
