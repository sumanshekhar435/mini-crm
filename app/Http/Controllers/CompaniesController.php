<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::get();
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
        $company = Company::find($request->input('id'));

        if ($company) {
            $company->delete();
            return response()->json(['message' => 'Company deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Company not found'], 404);
        }
    }
}
