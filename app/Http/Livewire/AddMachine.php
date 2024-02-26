<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Machines;
use App\Models\User;

class AddMachine extends Component
{

    public $machine_name;
    public $number_plate;
    public $model_number;
    public $worked_hours;
    public $plan;
    public $plan_hours;
    public $site;


    public function addMachine()
    {
        $data = $this->validate([
            'machine_name' => 'required|max:255',
            'number_plate' => 'required|unique:machines,number_plate',
            'model_number' => 'required|max:255',
            'worked_hours' => 'required|max:255',
            'plan' => 'required|max:255',
            'plan_hours' => 'required|max:255',
            'site' => 'required|max:255',
        ]);
      
        $addedMachine = Machines::create([
            'machine_name' => ucfirst($this->machine_name),
            'number_plate' => $this->number_plate,
            'model_number' => $this->model_number,
            'worked_hours' => $this->worked_hours,
            'plan' => $this->plan,
            'plan_hours' => $this->plan_hours,
            'site' => $this->site,
        ]);
        $this->machine_name = '';
        $this->number_plate = '';
        $this->model_number = '';
        $this->worked_hours = '';
        $this->plan = '';
        $this->plan_hours = '';
        $this->site = '';
        session()->flash('message', 'Machine added successfully 😁');
    }


    public function render()
    {
        return view('livewire.add-machine');
    }
}
