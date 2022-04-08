<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Session;

class UserController extends Controller
{
    const PAGINATION_NUMBER = 5;
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->middleware('auth');
        $this->userModel = $userModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLogged = Auth::user()->id;
        $users = $this->userModel::where('id' , '<>', $userLogged)->orderBy('id', 'desc')->get();
        // dd($users);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.action');
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
        $user = User::findOrFail($id);

        if ($user) {
            return view('users.action', compact('user'));
        }

        return redirect()->back();;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EditUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->first_name;
            $user->email = $request->first_name;
            $user->user_name = $request->first_name;
            if (!empty($requert->password))
            {
                $user->password = Hash::make($requert->password);
            }
            
            $user->update();
            Session::flash('message', __('Update success!'));
        } catch (\Exception $e) {
            Session::flash('message', __('Update false!'));

            return redirect()->back();
        }

        if ($user->id == Auth::user()->id) {
            return redirect()->route('home');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->tasks()->delete();
            $user->delete();
            Session::flash('message', __('Delete success!'));
        } catch (\Exception $e) {
            Session::flash('message', __('Delete fail!'));
        }
      
        return redirect()->route('users.index');
    }
}
