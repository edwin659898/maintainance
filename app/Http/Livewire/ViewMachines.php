<?php

namespace App\Http\Livewire;

use App\Models\Machines;
use Livewire\Component;
use Livewire\WithPagination;

class ViewMachines extends Component
{
    use WithPagination;
    public $search = '';
    public $post = 0;
    public $plan, $hours,$name,$plate,$machine_id,$milage;


    public function edit($id)
    {
        $machine = Machines::where('id', $id)->first();
        $this->name = $machine->machine_name;
        $this->plate = $machine->number_plate;
        $this->plan = $machine->plan;
        $this->hours = $machine->plan_hours;
        $this->milage = $machine->worked_hours;
        $this->machine_id = $id;
        $this->post = 1;
    }
  
    public function canReset($id){
        $machine = Machines::where('id', $id)->first();
        $machine->update([
             'completed' => false,
             'approved_plan' => false,
             'schedule_status' => false,
        ]);
        session()->flash('message', 'Machine Updated Successfully.');
    }

    public function back()
    {
        $this->post = 0;
        $this->search = '';
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'plan' => 'required',
            'hours' => 'required',
            'milage' => 'required'
        ]);

        if ($this->machine_id) {
            $machine = Machines::find($this->machine_id);
            $machine->update([
                'plan' => $this->plan,
                'plan_hours' => $this->hours,
                'worked_hours' => $this->milage,
            ]);
            $this->reset();
            session()->flash('message', 'Machine Updated Successfully.');
        }
    }

    public function render()
    {
        return view('livewire.view-machines',
        [
            'machines' => Machines::search($this->search)
                ->orderBy('machine_name', 'asc')
                ->paginate(10),
        ]);
    }
}
