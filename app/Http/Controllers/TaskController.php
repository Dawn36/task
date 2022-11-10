<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task= DB::select(DB::raw("SELECT t.*,c.`client_name` FROM `tasks` t LEFT JOIN `clients` c ON t.`client_id` = c.`id`"));
        return view('task/task_index',compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $client=Client::get();
        return view('task/task_create',compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $data = Task::create([
            'client_id' => $request->client_id,
            'task_name'=>$request->task_name,
            'notes'=>$request->notes,
            'status'=>$request->status,
            'additional_details'=>$request->additional_details,
            'user_id'=>Auth::user()->id,
            'created_at' => date("Y-m-d h:i:s"),
        ]);

        if ($request->hasFile('files')) {
            $id = $data->id;
            $file = $request->file('files');
            $path = "taskfile/" . $id;
            for ($i = 0; $i < count($file); $i++) {
                $size = $file[$i]->getSize();
                $filename = date('YmdHi') . $file[$i]->getClientOriginalName();
                $file[$i]->move(public_path($path), $filename);
                $paths = "taskfile/".$id."/".$filename;
                DB::table('task_files')->insert([
                    'task_id' => $id,
                    'user_id' => Auth::user()->id,
                    'file_name' => $filename,
                    'path' => $paths,
                    'size' => $size,
                    'created_at' => DATE("Y-m-d"),
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $task=Task::find($id);
        $taskFile=DB::table('task_files')->where('task_id',$id)->get();
        $client=Client::get();
        return view('task/task_show',compact('task','client','taskFile'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $task=Task::find($id);
        $client=Client::get();
        return view('task/task_edit',compact('task','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $task=Task::find($id);
        $task['client_id']=$request->client_id;
        $task['task_name']=$request->task_name;
        $task['notes']=$request->notes;
        $task['status']=$request->status;
        $task['additional_details']=$request->additional_details;
        $task->save();
        if ($request->hasFile('files')) {
            $id = $id;
            $file = $request->file('files');
            $path = "taskfile/" . $id;
            for ($i = 0; $i < count($file); $i++) {
                $size = $file[$i]->getSize();
                $filename = date('YmdHi') . $file[$i]->getClientOriginalName();
                $file[$i]->move(public_path($path), $filename);
                $paths = "taskfile/".$id."/".$filename;
                DB::table('task_files')->insert([
                    'task_id' => $id,
                    'user_id' => Auth::user()->id,
                    'file_name' => $file[$i]->getClientOriginalName(),
                    'path' => $paths,
                    'size' => $size,
                    'created_at' => DATE("Y-m-d"),
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = Task::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function tasksUpdate(Request $request)
    {
        $id= $request->taskId;
        $notes=$request->notes;
        $task=Task::find($id);
        $task['notes']=$notes;
        $task->save();

    }
}
