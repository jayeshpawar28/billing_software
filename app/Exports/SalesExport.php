<?php

namespace App\Exports;

use App\Models\SaleModel;
use Maatwebsite\Excel\Concerns\FromCollection;


class SalesExport implements FromCollection
{
    public function collection()
    {
        return SaleModel::all();
    }
}