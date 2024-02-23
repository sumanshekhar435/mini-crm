<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name', 'desc')->get();
        return view('pages.companies.companies', compact('companies'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies|max:255',
            'website' => 'required|url|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if ($request->has('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = 'uploads/logos/';
            $file->move($path, $filename);
        }
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $path . $filename,
        ]);
        return response()->json(['message' => 'Company successfully stored!', 'company' => $company], 200);
    }

    public function delete(Request $request)
    {
        $company = Company::find($request->id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
    
        $deleted = $company->delete();
    
        if ($deleted) {
            return response()->json(['message' => 'Company deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete company'], 500);
        }
    }

    public function edit($company_id)
    {
        $company = Company::find($company_id);
        return response()->json(['status' => 200, 'company' => $company]);
    }

    public function update(Request $request)
    {

        $company = Company::find($request->hidden_company_id);

        // Update company fields
        $company->name = $request->edit_company_name;
        $company->email = $request->edit_company_email;
        $company->website = $request->edit_company_website;
        if ($request->hasFile('edit_company_logo')) {
            if (File::exists($company->logo)) {
                File::delete($company->logo);
            }
            $file = $request->file('edit_company_logo');
            $filename = $file->getClientOriginalName();
            $path = 'uploads/logos/';
            $file->move($path, $filename);
            $full_path = $path . $filename;
            $company->logo = $full_path;
        }
        $company->save();
        return back()->with(['msg' => 'Company Data update successfully!']);
    }
}
