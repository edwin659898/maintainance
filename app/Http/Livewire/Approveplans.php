<?php

namespace App\Http\Livewire;

use App\Models\Machines;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Approveplans extends Component
{
    use WithPagination;
    public $name, $plate, $talk, $machine_id;
    public $post = 0;

    public function comment($id)
    {
        $machine = Machines::where('id', $id)->first();
        $this->name = $machine->machine_name;
        $this->plate = $machine->number_plate;
        $this->machine_id = $id;
        $this->post = 3;
    }

    public function cancel()
    {
        $this->post = 0;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'talk' => 'required',
        ]);

        if ($this->machine_id) {
            $machine = Machines::find($this->machine_id);
            $machine->update([
                'comment' => $this->talk,
            ]);
            $this->post = 0;
            $this->talk = "";
            session()->flash('message', 'Comment Updated Successfully.');
        }
    }

    public function approve($machineId)
    {
            $comment = Machines::find($machineId);
            $comment->update([
                "approved_plan" => 1
            ]);
            session()->flash('message', 'Plan Successfully approved');
    }

    public function render()
    {
        return view(
            'livewire.approveplans',
            [
                'machines' => Machines::where([['schedule_status', '=', 1],['approved_plan', '=', 0]])
                    ->orWhere([['plan_hours', '<', 2],['approved_plan', '=', 0]])
                    ->orderBy('machine_name', 'asc')
                    ->paginate(10),
            ]
        );
    }
}
