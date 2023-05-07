<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index' , compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUserRequest $request){
        $validated_data = $request->validated();
        $password = bcrypt($request->password);
        $validated_data['password'] = $password;
        User::create($validated_data);
        return redirect(route('users.index'))->with('message', 'Created!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request,$id){
        $user = User::findOrFail($id);
        $validated_data = $request->validated();
        $user->update($validated_data);
        return redirect(route('users.index'))->with('message', 'Updated!');
    }

    public function resetPasswordForm($id){
        $user = User::findOrFail($id);
        return view('users.reset_password',compact('user'));
    }

    public function resetPassword(ResetPasswordRequest $request , $id){
        $user = User::findOrFail($id);
        $validated_data = $request->validated();
        if ($request->has('password') && $request->password) {
            $password = bcrypt($request->password);
            $validated_data['password'] = $password;
        } else {
            unset($validated_data['password']);
        }
        $user->update($validated_data);
        return redirect(route('users.index'))->with('message', 'Reset Password!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($id);
            $deleted =  $user->delete();
            if ($deleted) {
                return response()->json(['status' => 'success', 'message' => 'deleted_successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'fail_while_delete']);
            }
        }
        return redirect()->route('users.index');
    }
}

