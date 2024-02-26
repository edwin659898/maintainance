<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MySubmit extends Component
{
    use WithPagination;
    public $search = '';
    
    public function render()
    {
        return view('livewire.my-submit', [
            'comments' => auth()->user()->myReports()
                        ->orderBy('date','DESC')
                        ->Paginate(10)
        ]);
    }
}
