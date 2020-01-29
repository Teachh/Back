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
        $initdate = date('d-m-Y');
        $limitdate = request('date');
        $finish = 0;
        $categoria = 0;
        $user_id = auth()->user()->id;

        if ($request->has('tipusUrgencia')) {
            $priority = 1;
        } else {
            $priority = 0;
        }

        $task->title = $title;
        $task->subject = $subject;
        $task->body =  $body;
        $task->limitdate = $limitdate;
        $task->user_id =  $user_id;
        $task->priority = $priority;
        $task->save();

        return redirect('/home#modalTask')->withStatus(__('web.task-created'));
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

    public function putEditDash(Request $request, $id)
    {
        /* $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required','string'],
            'message' => ['required', 'string'],
            'date' => ['required', 'date']
        ]);*/
        $t = new Task;
        $o = $t->findOrFail($id);
        $o->title = $request->input('title');
        $o->subject = $request->input('subject');
        $o->body =  $request->input('body');
        $o->limitdate = $request->input('limitdate');
        if ($request->has('tipusUrg')) {
            $o->priority = 1;
        } else {
            $o->priority = 0;
        }
        $o->save();

        return redirect('/home#modalTask')->withStatus(__('web.task-created'));
    }



    public function putFinishDash(Request $request, $id)
    {
        $t = Task::findOrFail($id);
        if ($request->has('finishA')) {
            $t->finish = 1;
        } else {
            $t->finish = 0;
        }
        $t->save();


        return redirect('/home#modalTask')->withStatus(__('web.task-created'));
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

    public function deleteDash($id)
    {
        $p = new Task;
        $o = $p->findOrFail($id);
        $o->delete();

        return redirect('/home#modalTask')->withStatus(__('web.nota-deleted'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::paginate(5);
            return view('dashboard', compact('data'))->render();
        }
    }
}
