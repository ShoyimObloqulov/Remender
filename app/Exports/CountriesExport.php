<?php

namespace App\Exports;

use App\Models\Country;
use App\Models\States;
use Maatwebsite\Excel\Concerns\FromCollection;

class CountriesExport implements FromCollection
{
    public function collection()
    {
        return States::select('name', 'id')->get();
    }

    public function headings(): array
    {
        return ['Имя', 'ID'];
    }
}
