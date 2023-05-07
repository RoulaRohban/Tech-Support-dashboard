<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\ResetCustomerPasswordRequest;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customers.index' , compact('customers'));
    }
    public function create(){
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request){
        $validated_data = $request->validated();
        $password = bcrypt($request->password);
        $validated_data['password'] = $password;
        Customer::create($validated_data);
        return redirect(route('customers.index'))->with('message', 'Created!');
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return view('customers.edit',compact('customer'));
    }

    public function update(UpdateCustomerRequest $request,$id){
        $customer = Customer::findOrFail($id);
        $validated_data = $request->validated();
        $customer->update($validated_data);
        return redirect(route('customers.index'))->with('message', 'Updated!');
    }

    public function resetPasswordForm($id){
        $customer = Customer::findOrFail($id);
        return view('customers.reset_password',compact('customer'));
    }

    public function resetPassword(ResetCustomerPasswordRequest $request , $id){
        $customer = Customer::findOrFail($id);
        $validated_data = $request->validated();
        if ($request->has('password') && $request->password) {
            $password = bcrypt($request->password);
            $validated_data['password'] = $password;
        } else {
            unset($validated_data['password']);
        }
        $customer->update($validated_data);
        return redirect(route('customers.index'))->with('message', 'Reset Password!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $customer = Customer::findOrFail($id);
            $deleted =  $customer->delete();
            if ($deleted) {
                return response()->json(['status' => 'success', 'message' => 'deleted_successfully']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'fail_while_delete']);
            }
        }
        return redirect()->route('customers.index');
    }
}

