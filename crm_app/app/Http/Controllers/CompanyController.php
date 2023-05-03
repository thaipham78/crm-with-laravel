<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('limit')) {
            $limit = $request->input('limit');
        } else {
            $limit = 5;
        }

        if ($request->has('offset')) {
            $offset = $request->input('offset');
        } else {
            $offset = 0;
        }

        $success = Company::skip($offset)->take($limit)->get();
        return [
            $success,
        ];
    }

    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        $queryCompany = $company::where('name', $request->input('name'))->get();
        // return [empty($queryContacts)];

        foreach ($queryCompany as $_company) {
            // return [$_contact];
            if (!property_exists($_company, 'id')) {
                $item = $_company->name;
                if ($item == $request->input('name')) {
                    return "User exits";
                } else {
                    $success = $company::create($validated);
                    return $success;
                }
            }

        }
        $success = $company::create($validated);
        return $success;
    }

    public function show(string $id)
    {
        $success = Company::find($id);
        // $success=DB::table('users')->where('id', $id)->first();

        return $success;

    }
    public function update(Request $request, $id, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        $queryCompany = $company::where('name', $request->input('name'))->get()->except($id);
        foreach ($queryCompany as $_company) {
            // return [$_contact];
            if (!property_exists($_company, 'id')) {
                $item = $_company->name;
                if ($item == $request->input('name')) {
                    return "User exits";
                } else {
                    $success = $company::where('id', $id)->update($validated);
                    return $success;
                }
            }

        }
        $success = $company::where('id', $id)->update($validated);
        return $success;
    }

    public function destroy(Company $company, $id)
    {
        $success = $company::where('id', $id)->delete();
        return $success;
    }

}
