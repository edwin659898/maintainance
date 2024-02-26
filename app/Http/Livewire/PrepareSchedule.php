<?php

namespace App\Http\Livewire;

use App\Models\Calendar;
use App\Models\Machines;
use Livewire\WithPagination;

use Livewire\Component;

class PrepareSchedule extends Component
{

    use WithPagination;
    public $user;
    public $scheduleType;
    public $date;

    public function remove($commentId)
    {
        if ($this->scheduleType == 'Weekly') {
            $comment = Machines::find($commentId);
            $comment->update([
                'process_owner' => $this->user->id, 'date' => $this->date,
                "schedule_status" => 1, "type" => 'Weekly'
            ]);
            Calendar::create(['user_id' => auth()->id(), 'date' => $this->date, 'site' => $comment->site, "machine_name" => $comment->machine_name . '-' . $comment->number_plate]);
            session()->flash('message', 'Machine successfully Scheduled 😁');
        } else {
            $comment = Machines::find($commentId);
            $comment->update([
                'process_owner' => $this->user->id, 'date' => $this->date, "schedule_status" => 1, "type" => 'Daily'
            ]);
            Calendar::create(['user_id' => auth()->id(), 'date' => $this->date, 'site' => $comment->site, "machine_name" => $comment->machine_name . '-' . $comment->number_plate]);
            session()->flash('message', 'Machine successfully Scheduled 😁');
        }
    }

    public function render()
    {
        if (auth()->user()->site == '7 Forks') {
            $machines = Machines::where([['schedule_status', '=', 0], ['site', '=', $this->user->site]])
                ->orWhere([['schedule_status', '=', 0], ['site', '=', 'GIC']])
                ->orderBy('machine_name', 'asc')
                ->Paginate(10);
        } else {
            $machines = Machines::where([['schedule_status', '=', 0], ['site', '=', $this->user->site]])
                ->orderBy('machine_name', 'asc')
                ->Paginate(10);
        }
        return view('livewire.prepare-schedule', [
            'comments' => $machines
        ]);
    }
}
