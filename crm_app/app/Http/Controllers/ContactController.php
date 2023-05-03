<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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

        $success = Contact::skip($offset)->take($limit)->get();
        return [
            $success,
        ];
    }

    public function store(Request $request, Contact $contact, Company $company)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string',
            'company_id' => 'required',
        ]);

        $queryContacts = $contact::where('first_name', '=', $request->input('first_name'))->get();
        // return [empty($queryContacts)];

        foreach ($queryContacts as $_contact) {
            // return [$_contact];
            if (!property_exists($_contact, 'id')) {
                $item = $_contact->last_name;
                if ($item == $request->input('last_name')) {
                    return "User exits";
                } else {
                    $success = $contact::create($validated);
                    return [$success];
                }
            }

        }
        $success = $contact::create($validated);
        return $success;

    }

    public function show($id)
    {
        // Cache::flush();
        // Cache::forget('key','$success');
        $succes = Contact::find($id);

        return $succes;
    }

    public function update(Request $request, $id, Contact $contact, Company $company)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string',
            'company_id' => 'required',
        ]);

        $queryContacts = Contact::where('first_name', $request->input('first_name'))->get()->except($id);
        foreach ($queryContacts as $_contact) {
            // return [$_contact];
            if (!property_exists($_contact, 'id')) {
                $item = $_contact->last_name;
                if ($item == $request->input('last_name')) {
                    return "User exits";
                } else {
                    $success = $contact::create($validated);
                    return [$success];
                }
            }

        }
        $success = $contact::create($validated);
        return $success;
    }

    public function destroy(Contact $contact, $id)
    {
        $success = $contact::where('id', $id)->delete();
        return [
            'success' => $success,
        ];
    }
}
