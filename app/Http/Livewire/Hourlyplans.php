<?php

namespace App\Http\Livewire;

use App\Models\Machines;
use Livewire\WithPagination;
use Livewire\Component;


class Hourlyplans extends Component
{
    use WithPagination;
    public $user;

    public function render()
    {
        return view(
            'livewire.hourlyplans',
            ['machines' => Machines::where([['plan_hours', '<', 2],['site','=',$this->user->site]])
                ->Paginate(10),]
        );
    }
}
