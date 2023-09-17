<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TaskTemplate;
use DataTables;

class TaskTemplateController extends Controller
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
        return view('task_template.index', [
            'users'=>User::all(['id', 'first_name', 'last_name'])->toArray(),
            'periods' => $this->periods,
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
        //
        $TaskTemplate = new TaskTemplate();

        $TaskTemplate->name = $req->input('name');
        $TaskTemplate->user_id = $req->input('user_id');
        $TaskTemplate->count = $req->input('count');
        $TaskTemplate->period = $req->input('period');
        $TaskTemplate->description = $req->input('description');
        $url = url()->previous();
        if($TaskTemplate->save()){
            return redirect()->to($url)->with('success',  'Task Template is created');
        }

        return redirect()->to($url)->with('danger',  'Task Template some error');
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
        //
        $url = url()->previous();
        if(empty($req->id)){
            return redirect()->to($url)->with('danger',  'Task Template not found');
        }

        $TaskTemplate = TaskTemplate::find($req->id);

        if(empty($TaskTemplate)){
            return redirect()->to($url)->with('danger',  'Task Template not found');
        }

        $TaskTemplate->name = $req->input('name');
        $TaskTemplate->user_id = $req->input('user_id');
        $TaskTemplate->count = $req->input('count');
        $TaskTemplate->period = $req->input('period');
        // $TaskTemplate->description = $req->input('description');
        if($TaskTemplate->save()){
            return redirect()->to($url)->with('success',  'Task Template is Edited');
        }
        return redirect()->to($url)->with('danger',  'Task Template some error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $url = url()->previous();
        if(empty($id)){
            return redirect()->to($url)->with('danger',  'Task Template not found');
        }
        $TaskTemplate = TaskTemplate::find($id);

        if(empty($TaskTemplate)){
            return redirect()->to($url)->with('danger',  'Task Template not found');
        }

        if($TaskTemplate->delete()){
            return redirect()->to($url)->with('success',  'Task Template is Deleted');
        }
        return redirect()->to($url)->with('danger',  'Task Template some error');
    }

    public function Dtask_template(Request $req){
        
        if ($req->ajax()) {
            $data = TaskTemplate::with('user:id,first_name,last_name')->get()->toArray();

            // dump($data);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->addColumn('Assigned_to', function($row){
                    if($row['user']){
                        return $row['user']['last_name'];
                    }
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
