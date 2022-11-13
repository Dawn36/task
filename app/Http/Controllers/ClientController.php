<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinet = Client::Get();
        return view('client/client_index', compact('clinet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client/client_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Client::create([
            'client_note' => $request->client_note,
            'client_name'=>$request->client_name,
            'user_id'=>Auth::user()->id,
            'created_at' => date("Y-m-d h:i:s"),
        ]);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $client=Client::find($id);
        $task= DB::select(DB::raw("SELECT t.*,c.`client_name` FROM `tasks` t LEFT JOIN `clients` c ON t.`client_id` = c.`id` where t.`client_id`=$id order by t.task_id asc"));
     
        $clientFile=DB::table('client_file')->where('client_id',$id)->get();
        return view('client/client_show',compact('client','clientFile','task'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $client=Client::find($id);
        return view('client/client_edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $client=Client::find($id);
        if(isset($request->client_note))
        {
            $client['client_note']=$request->client_note;
        }
        if(isset($request->client_name))
        {
            $client['client_name']=$request->client_name;
            
        }
        if(isset($request->master_status))
        {
            
            $client['master_status']=$request->master_status;
        }
        if(isset($request->contact_name))
        {
            $client['contact_name']=$request->contact_name;
            
        }
        if(isset($request->website))
        {
            
            $client['website']=$request->website;
        }
        if(isset($request->phone))
        {
            $client['phone']=$request->phone;
            
        }
        if(isset($request->email_address))
        {
            
            $client['email_address']=$request->email_address;
        }
        if(isset($request->account_note))
        {
            $client['account_note']=$request->account_note;
            
        }

        $client->save();
        if ($request->hasFile('files')) {
            $id = $id;
            $file = $request->file('files');
            $path = "clientFile/" . $id;
            for ($i = 0; $i < count($file); $i++) {
                $size = $file[$i]->getSize();
                $filename = date('YmdHi') . $file[$i]->getClientOriginalName();
                $file[$i]->move(public_path($path), $filename);
                $paths = "clientFile/".$id."/".$filename;
                DB::table('client_file')->insert([
                    'client_id' => $id,
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $data = Client::find($id);
        $data->delete();
        return redirect()->back();
    }
}
