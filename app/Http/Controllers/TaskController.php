<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use App\Defines\Define;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = DB::table('tasks')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->select('tasks.*', 'users.first_name', 'users.last_name')
            ->orderBy('tasks.id', 'desc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }
    
    public function getTasksByUserId($user_id)
    {
        $tasks = DB::table('tasks')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->select('tasks.*', 'users.first_name', 'users.last_name')
            ->where('tasks.user_id', $user_id)
            ->orderBy('tasks.id', 'desc')
            ->get();

        return view('tasks.index', compact('tasks', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        return view('tasks.action', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AddTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTaskRequest $request)
    {
        $user_id = $request->user_id;

        try {
            $data = $request->validated();
            Task::create($data);
            Session::flash('message', __('Add success!'));
        } catch (\Exception $e) {
            Session::flash('message', __('Add fail!'));
        }

        return redirect()->route('tasks.get_tasks_by_user_id', $user_id);
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
        $task = DB::table('tasks')->where('id', $id)->first();

        return view('tasks.action', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EditTaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTaskRequest $request, $id)
    {
        $user_id = $request->user_id;

        try {
            $task = Task::findOrFail($id);
            $data = $request->all();
            $task->update($data);
        } catch (\Exception $e) {
            Session::flash('message', __('Update false!'));
        }

        return redirect()->route('tasks.get_tasks_by_user_id', $user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task->status == Define::INPROGRESS) {
            Session::flash('message', __('Can\'t delete!'));
            return redirect()->back();
        }
        $task->delete();
        
        return redirect()->back();
    }
}
