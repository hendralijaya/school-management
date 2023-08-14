<?php

namespace App\OpenApi\Parameters\API\v1\KategoriKegiatan;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListKategoriKegiatanParameters extends ParametersFactory
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
