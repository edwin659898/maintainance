<?php

namespace App\Http\Livewire;

use App\Exports\ReportExport;
use Livewire\Component;
use App\Models\Report;
use Livewire\WithPagination;

class ApprovedReports extends Component
{
    use WithPagination;
    public $search;
    public $reports = [];
    public $selectAll = [];
    protected $queryString = ['search' => ['except' => '']];

    public function isChecked($id)
    {
        return in_array($id, $this->reports);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->reports = Report::pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->reports = [];
        }
    }

    public function GenerateExcel()
    {
        if (!empty($this->reports)) {
            return (new ReportExport($this->reports))->download('Reports.xlsx');
        } else {
            session()->flash('error', 'You have not selected any report to be exported');
        }
    }

    public function render()
    {
        return view('livewire.approved-reports', [
            'comments' => Report::search($this->search)
                ->where('status', '=', 'HOD approved')
                ->orderBy('date', 'DESC')
                ->Paginate(10)
        ]);
    }
}
