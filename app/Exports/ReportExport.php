<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Date Submitted',
            'Submitted By',
            'Site',
            'Machine Name',
            'Number Plate',
            'Report Type',
            'Milage Reading',
            'Date Appproved',
            'Admin Comment',
        ];
    }

    public function query()
    {
        return Report::query()->whereKey($this->reports)->select(
            [
                'id',
                'date',
                'owner',
                'site',
                'machine_name',
                'number_plate',
                'type',
                'milage',
                'approved_date',
                'admincomment'
            ]
        );
    }
}
