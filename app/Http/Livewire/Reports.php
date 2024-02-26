<?php

namespace App\Http\Livewire;

use App\Models\Report;
use App\Models\Header;
use App\Models\Machines;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Rejected;

class Reports extends Component
{
    use WithPagination;

    public $search = '';
    public $post = 0;
    public $date, $owner, $site, $name, $plate, $type, $report_id;
    public $lists, $approvaldate;
    public $admincomment, $decision;
    public $supervisor;
    public $milage, $plan_hours, $plan, $files,$email;

    public function back()
    {
        $this->post = 0;
        $this->search = "";
    }

    public function details($id)
    {
        $comment = Report::where('id', $id)->first();
        $this->date = $comment->date;
        $this->owner = $comment->owner;
        $this->site = $comment->site;
        $this->name = $comment->machine_name;
        $this->plate = $comment->number_plate;
        $this->type = $comment->type;
        $this->lists = $comment->headers;
        $this->email = $comment->UserMail->email;
        $this->files = $comment->images;
        $this->milage = $comment->milage;
        $this->plan_hours = $comment->plan_hours;
        $this->plan = $comment->plan;
        $this->approvaldate = Carbon::today()->toDateString();
        $this->supervisor = auth()->user()->name;

        $this->report_id = $id;
        $this->post = 1;
    }

    public function update($id)
    {
        $data = $this->validate([
            'supervisor' => 'required',
            'approvaldate' => 'required',
        ]);
        $comment = Report::where('id', $id)->first();
        $comment->update([
            'status' => $this->decision,
            'approved_by' => $this->supervisor,
            'approved_date' => $this->approvaldate,
            'admincomment' => $this->admincomment,
        ]);
      
        if ($this->decision == 'HOD approved') {
            $machine = Machines::where([['machine_name', 'like', '%' . $this->name . '%'], ['number_plate', 'like', '%' . $this->plate . '%']])
                ->first();
            if (strtolower($this->type) == 'daily' || strtolower($this->type) == 'weekly') {
                $machine->update([
                    'worked_hours' => $this->milage, 'plan_hours' => $this->plan_hours, 'completed' => 0,
                    'date' => null, 'type' => null, 'schedule_status' => 0, 'approved_plan' => 0, 'comment' => null, 'process_owner' => null
                ]);
            } else {
                $machine->update([
                    'plan' => $this->plan, 'plan_hours' => $this->plan_hours, 'completed' => 0,
                ]);
            }
        } else {
            $email = $this->email;
            Mail::to($email)->send(new Rejected(auth()->user()));
        }
        $this->post = 0;
        $this->search = "";
        $this->admincomment = "";
        $this->decision = "";
        session()->flash('message', 'Decision Updated successfully 😁');
    }

    public function render()
    {
        return view('livewire.reports', [
            'comments' => Report::search($this->search)
                ->where('status', '=', 'pending')
                ->orderBy('date', 'DESC')
                ->Paginate(10)
        ]);
    }
}
