<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(request('q') != null)
        {

            $tasks['data'] = Task::where('tache', 'like', '%'.request('q').'%')->get();
            return response()->json($tasks);

        }
        else
        {

            $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);

            return response()->json($tasks);

        }

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
    public function store(Request $request)
    {
        //
        $addTask = Task::create($request->all());

        if($addTask)
        {

            $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);

            return response()->json($tasks);

        }
        
        /*$addTask = Task::create($request->all());
        $addTask->save();*/

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
        $showTask = Task::find($id);

        return response()->json($showTask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $editTask = Task::find($id);
        $editTask->tache = request('tache');
        $editTask->save();

        if($editTask)
        {

            $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
    
            return response()->json($tasks);

        }

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
        $deleteTask = Task::find($id)->delete();

        if($deleteTask)
        {

            $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
    
            return response()->json($tasks);

        }

    }
}
