<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\hours;
use App\Models\check;
use Livewire\WithPagination;

class Checklist extends Component
{
    use WithPagination;
    public $post = 0;
    public $name, $hour,$lists,$machine_id,$list_id;
    public $list;
    public $search = '';

    public function details($id)
    {
        $comment = hours::where('id', $id)->first();
        $this->name = $comment->machine_name;
        $this->hour = $comment->hours;
        $this->lists = $comment->checklist;
        $this->machine_id = $id;
        $this->post = 1;
    }

    public function addlist($id)
    {
        $comment = hours::where('id', $id)->first();
        $this->name = $comment->machine_name;
        $this->hour = $comment->hours;
        $this->machine_id = $id;
        $this->post = 2;
        $this->search = "";
    }
    

    public function newlist($id)
    {
        
        $comment = hours::where('id', $id)->first();
        $comment->checklist()->create([
            'checklist' => $this->list,
        ]);
        $this->list = "";
        $this->post = 0;
        $this->search = "";
        session()->flash('message', 'List added Successfully.');
    }

    public function delete($id)
    {
        if($id){
            check::where('id',$id)->delete();
            $this->post = 0;
            $this->search = "";
            session()->flash('message', 'Item Deleted Successfully.');
        }
    }

    public function back()
    {
        $this->post = 0;
        $this->search = "";
    }

    public function render()
    {
        return view('livewire.checklist', [
            'comments' => hours::search($this->search)
                        ->orderBy('machine_name','ASC')
                        ->simplePaginate(10)
        ]);
    }
}
