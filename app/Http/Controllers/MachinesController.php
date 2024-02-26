<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Checklist;
use Illuminate\Http\Request;
use App\models\User;
use Carbon\Carbon;
use Auth;
use App\Models\Machines;
use App\Models\check;
use App\Models\hours;
use App\Models\Report;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notify;
use App\Models\Header;
use App\Models\Image;
use PDF;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //MACHINES
    public function addMachine()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/machine');
    }

    public function viewMachine()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/machinelist');
    }

    //PrepareSchedules
    public function dailySchedule()
    {
        $date = Carbon::tomorrow()->toDateString();
        $scheduleType = "Daily";
        $user = Auth::user();
        return view('checklist/schedule')->with(['user' => $user, 'date' => $date, 'scheduleType' => $scheduleType]);
    }

    public function weeklySchedule()
    {
        $date = Carbon::parse('next saturday')->toDateString();
        $scheduleType = "Weekly";
        $user = Auth::user();
        return view('checklist/schedule')->with(['user' => $user, 'date' => $date, 'scheduleType' => $scheduleType]);
    }

    //View Schedules
    public function dailyPlan()
    {
        $user = Auth::user();
        $scheduleType = "Daily";
        return view('checklist/plan')->with(['user' => $user, 'scheduleType' => $scheduleType]);
    }

    public function weeklyPlan()
    {
        $user = Auth::user();
        $scheduleType = "Weekly";
        return view('checklist/plan')->with(['user' => $user, 'scheduleType' => $scheduleType]);
    }

    public function hourlyPlan()
    {
        $user = Auth::user();
        return view('checklist/hourlyPlan')->with(['user' => $user]);
    }

    //PlanApproval
    public function approvePlan()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/approvePlan');
    }

    //Add/View Checklist
    public function addChecklist()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/addChecklist');
    }

    public function storeList(Request $request)
    {
        $data = request()->validate([
            'check.hours' => 'required',
            'check.machine_name' => 'required',
            'items.*.checklist' => 'required',
        ]);
      
        $data['check']['machine_name'] = ucfirst($data['check']['machine_name']);
                                                 
        $checklist = hours::create($data['check']);
        $checklist->checklist()->createMany($data['items']);
        return redirect()->back()->with('message', 'Maintainance checklist created Successfully');
    }

    public function showList()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/showList');
    }

    //Search and Store Report
    public function searchList(Request $request)
    {
        $machine = Machines::where([['machine_name', 'like', '%' . $request->machine_name . '%'], ['number_plate', 'like', '%' . $request->number_plate . '%']])
        ->first();
        $data = hours::where('machine_name', $request->machine_name)
            ->where('hours', $request->type)
            ->first();

        if ($data == null) {
            return redirect()->back()->with('error', 'The checklist has not been added yet');
        } elseif (strtolower($data->hours) == 'weekly' || strtolower($data->hours) == 'daily') {
            return view('/checklist/formD')->with(['machine' => $machine, 'data' => $data]);
        } else {
            return view('/checklist/formHour')->with(['machine' => $machine, 'data' => $data]);
        }
    }

    public function storeReport(Request $request, $id)
    {
        $machine = Machines::find($id);
        $machine->update([
            'completed' => 1
        ]);
        $data = $request->all();
        $results = auth()->user()->myReports()->create($data['report']);
        $results->headers()->createMany($data['list']);
        if ($request->hasfile('image')) {
            $filename = $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/images/', $filename);
            $results->images()->Create(['image' => $filename]);
        }
        Mail::to('operations@betterglobeforestry.com')->send(new Notify(auth()->user()));
        return redirect('/SentReports')->with('message', 'Report successfully submitted');
    }

    public function storeReportB(Request $request, $id)
    {
        $machine = Machines::find($id);
        $machine->update([
            'completed' => 1
        ]);

        $data = $request->all();
        $results = auth()->user()->myReports()->create($data['report']);
        $results->headers()->createMany($data['list']);
        Mail::to('operations@betterglobeforestry.com')->send(new Notify(auth()->user()));
        return redirect('/SentReports')->with('message', 'Report successfully submitted');
    }

    //Update Report
    public function updateD(Request $request, $id)
    {
        $machine = Report::find($id);
        if ($machine->status != 'HOD declined') {
            return redirect('/SentReports')->with('error', 'No authority to Update yet');
        }
        if ($request->type == 'Weekly' || $request->type == 'Daily' || $request->type == 'daily') {
            $machine->update([
                'milage' => $request->milage, 'plan_hours' => $request->plan_hours, 'status' => 'pending'
            ]);
        } else {
            $machine->update([
                'plan' => $request->plan, 'plan_hours' => $request->plan_hours, 'status' => 'pending'
            ]);
        }

        if ($request->answer) {
            foreach ($request->answer as $key => $value) {
                $id = $request->listId[$key];
                $item = Header::find($id);
                $comment = $request->comment[$key];
                $item->update([
                    'answer' => $value, 'comment' => $comment
                ]);
            }
        }
        Mail::to('opearations@betterglobeforestry.com')->send(new Notify(auth()->user()));
        return redirect('/SentReports')->with('message', 'Report Updated');
    }

    //Report Approval
    public function approveReport()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/Report');
    }

    //Approved Reports
    public function final()
    {
        if (auth()->user()->role != True) {
            return redirect()->back()->with('error', 'Denied Access');
        }
        return view('checklist/tableReport');
    }

    public function view($id)
    {
        $comment = Report::find($id);
        $comment->load('headers');
        return view('checklist/view', compact('comment'));
    }

    //MySent Reports
    public function sentReports()
    {
        return view('checklist/sentReports');
    }

    public function myreport(Request $request, $id)
    {
        $data = Machines::where([['machine_name', 'like', '%' . $request->machine_name . '%'], ['number_plate', 'like', '%' . $request->number_plate . '%']])
            ->first();
        $machine = Report::find($id);
        if ($machine->type == 'Daily' || $machine->type == 'Weekly') {
            return view('checklist/updateD')->with(['data' => $data, 'machine' => $machine]);
        } else {
            return view('checklist/UpdateHourly')->with(['machine' => $machine]);
        }
    }

    //file
    public function file($id)
    {
        $image = Image::find($id);
        $filename = $image->image;
        $path = storage_path('app/public/images/' . $filename);
        return response()->file($path);
    }

    // //PDF
    // public function PDFDownload($id){
    //     $data = Report::with('headers')->findOrFail($id)->toArray();
    //     $pdf = \PDF::loadView('checklist/download', $data);
    //     return $pdf->stream();
    // }
}
