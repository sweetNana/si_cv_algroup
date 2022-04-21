<?php

namespace App\Exports;

use App\Models\BrgMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class BrgMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BrgMasuk::all();
    }
}
