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
        return Task::all();
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

    public function createDash(Request $request)
    {
       /* $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required','string'],
            'message' => ['required', 'string'],
            'date' => ['required', 'date']
        ]);*/

        $task = new Task();
        $title = request('name');
        $subject = request('email');
        $body = request('message');
        $initdate = ;
        $limitdate = request('date');
        $finish = 0;
        $categoria= 0;
        $user_id = ;
        $priority = request('tipusUrgencia');;

        $task->title = $title;
        $task->subject = $subject;
        $task->body =  $body;
        $task->limitdate = $limitdate;
        $task->user_id = ;
        //$task->tipusUrgencia = request('tipusUrgencia');
        $task->save();

        return redirect('/home')->withStatus(__('web.task-created'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Task::where('id', $id)->get();

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
    public function update(Request $request, $id)
    {
        //
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
    }
}
