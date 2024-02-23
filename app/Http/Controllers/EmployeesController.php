<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    public function index()
    {
        $company = Company::get();
        $employees = Employee::get();
        return view('pages.employees.employees', compact('company', 'employees'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies|max:255',
            'phone' => 'required',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $company = Employee::create([
            'company_id' => $request->company,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return response()->json(['message' => 'Company successfully stored!', 'company' => $company], 200);
    }

    public function delete(Request $request)
    {
        $Employee = Employee::find($request->id);

        if (!$Employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $deleted = $Employee->delete();

        if ($deleted) {
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete Employee'], 500);
        }
    }

    public function edit($employees_id)
    {
        $employee = Employee::find($employees_id);
        return response()->json(['status' => 200, 'employee' => $employee]);
    }

    public function update(Request $request)
    {

        $employee = Employee::find($request->hidden_employees_id);

        // Update company fields
        $employee->company_id = $request->edit_company;
        $employee->first_name = $request->edit_employees_first_name;
        $employee->last_name = $request->edit_employees_last_name;
        $employee->email = $request->edit_employees_email;
        $employee->phone = $request->edit_employees_phone;
        $employee->save();
        return back()->with(['msg' => 'Employee Data update successfully!']);
    }
}
