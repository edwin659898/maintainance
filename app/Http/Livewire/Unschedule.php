<?php

namespace App\Http\Livewire;

use App\Models\Calendar;
use Livewire\Component;
use App\Models\Machines;
use Livewire\WithPagination;

class Unschedule extends Component
{

    use WithPagination;
    public $user;
    public $scheduleType;


    public function remove($commentId)
    {
        $comment = Machines::find($commentId);
        Calendar::where([
            ['user_id', auth()->id()],
            ['date', '=', $comment->date], ['machine_name', '=', $comment->machine_name.'-'.$comment->number_plate]
        ])->first()->delete();
        $comment->update(['process_owner' => null, 'date' => null, 'type' => null, "schedule_status" => 0]);
        session()->flash('message', 'Machine successfully Removed from Plan');
    }

    public function render()
    {
        if ($this->scheduleType == "Weekly") {
            return view('livewire.unschedule', [
                'comments' => Machines::where('schedule_status', '=', 1)
                    ->where('process_owner', '=', $this->user->id)
                    ->where('type', '=', 'Weekly')
                    ->orderBy('machine_name', 'asc')
                    ->paginate(10),
            ]);
        } else {
            return view('livewire.unschedule', [
                'comments' => Machines::where('schedule_status', '=', 1)
                    ->where('process_owner', '=', $this->user->id)
                    ->where('type', '=', 'Daily')
                    ->orderBy('machine_name', 'asc')
                    ->paginate(10),

            ]);
        }
    }
}
