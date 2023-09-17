<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskSetRelation;
use App\Models\TaskTemplate;
use App\Models\TaskSet;
use App\Models\User;
use DataTables;
use Auth;

//https://api.jqueryui.com/sortable/#event-change
class TaskSetController extends Controller
{
    public $periods = [
        'Day', 'Week', 'Month', 'Year'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('task_set.index', [
            'users'=>User::all(['id', 'first_name', 'last_name'])->toArray(),
            'periods' => $this->periods,
            'task_sets' => TaskSet::with('user:id,first_name,last_name')->with('taskRelation')->get()->toArray(),
            'task_templates' => TaskTemplate::with('user:id,first_name,last_name')->get()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $TaskSet = new TaskSet();
        $TaskSet->name = $req->input('name')??'Unknown';
        $TaskSet->user_id = Auth::user()->id;
        $TaskSet->company_id = $req->input('company_id');
        $url = url()->previous();
        if($TaskSet->save()){
            $count = 1;
            foreach($req->data as $data){
                $TaskSetRelation = new TaskSetRelation();
                $TaskSetRelation->task_set_id = $TaskSet->id;
                $TaskSetRelation->name = $data['name'];
                $TaskSetRelation->count = $data['count'];
                $TaskSetRelation->period = $data['period'];
                $TaskSetRelation->user_id = $data['user_id'];
                $TaskSetRelation->description = $data['description'];
                $TaskSetRelation->positions = $count;
                $TaskSetRelation->save();
                $count++;
            }
            return redirect()->to($url)->with('success',  'Task Set is created');
        }
        return redirect()->to($url)->with('danger',  'Task Set some error');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $url = url()->previous();
        if(empty($req->id)){
            return redirect()->to($url)->with('danger',  'Task Template not found');
        }
        $TaskSet = TaskSet::find($req->id);
        $TaskSet->name = $req->input('name')??'Unknown';
        if(!empty($req->input('page_id'))){
            $TaskSet->company_id = $req->input('page_id');
        }
        
        $TaskSet->user_id = Auth::user()->id;

        if($TaskSet->save()){
            $TaskSetRelation = TaskSetRelation::where('task_set_id', $req->id)->delete();
            $count = 1;
            foreach($req->data as $data){
                $TaskSetRelation = new TaskSetRelation();
                $TaskSetRelation->task_set_id = $TaskSet->id;
                $TaskSetRelation->name = $data['name'];
                $TaskSetRelation->count = $data['count'];
                $TaskSetRelation->period = $data['period'];
                $TaskSetRelation->user_id = $data['user_id'];
                $TaskSetRelation->description = $data['description'];
                $TaskSetRelation->positions = $count;
                $TaskSetRelation->save();
                $count++;
            }
            return redirect()->to($url)->with('success',  'Task Set is created');
        }
        return redirect()->to($url)->with('danger',  'Task Set some error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = url()->previous();
        if(empty($id)){
            return redirect()->to($url)->with('danger',  'Task Set not found');
        }
        $TaskSet = TaskSet::find($id);

        if(empty($TaskSet)){
            return redirect()->to($url)->with('danger',  'Task Set not found');
        }

        if($TaskSet->delete()){
            return redirect()->to($url)->with('success',  'Task Set is Deleted');
        }
        return redirect()->to($url)->with('danger',  'Task Set some error');
    }

    public function add_task_set_company(Request $req)
    {
        $TaskSet = new TaskSet();
        $TaskSet->name = $req->input('name')??'Unknown';
        $TaskSet->user_id = Auth::user()->id;
        $TaskSet->company_id = $req->input('page_id');
        $url = url()->previous();
        if($TaskSet->save()){
            $count = 1;
            foreach($req->data as $data){
                $TaskSetRelation = new TaskSetRelation();
                $TaskSetRelation->task_set_id = $TaskSet->id;
                $TaskSetRelation->name = $data['name'];
                $TaskSetRelation->count = $data['count'];
                $TaskSetRelation->period = $data['period'];
                $TaskSetRelation->user_id = $data['user_id'];
                $TaskSetRelation->description = $data['description'];
                $TaskSetRelation->positions = $count;
                $TaskSetRelation->save();
                $count++;
            }
            return redirect()->to($url)->with('success',  'Task Set is created');
        }
        return redirect()->to($url)->with('danger',  'Task Set some error');
    }

    public function Dtask_set(Request $req){
        
        if ($req->ajax()) {
            $data = TaskSet::with('user:id,first_name,last_name')->with('taskRelation')->get()->toArray();

            // dump($data);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('Tasks_count', function($row){
                    if(!empty($row['task_relation'])){
                        return count($row['task_relation']);
                    }
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
