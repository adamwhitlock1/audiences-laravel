<?php

namespace App\Http\Controllers;

use App\Audience;
use App\Imports\AudiencesImport;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AudiencesController extends Controller
{
    public function index()
    {
        return Inertia::render('Audiences/Index', [
            'filters' => Request::all('search', 'trashed'),
            'audiences' => Auth::user()->account->audiences()
                ->paginate()
                ->transform(function ($audience) {
                    return [
                        'id' => $audience->id,
                        'name' => $audience->name,
                        'facebook_id' => $audience->facebook_id,
                        'odc_id' => $audience->odc_id,
                        'type' => $audience->type,
                        'sla' => $audience->sla,
                        'estimated_size' => $audience->estimated_size,
                        'description' => $audience->description,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Audiences/Create', [
            'organizations' => Auth::user()->account
                ->organizations()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    public function store()
    {
        Auth::user()->account->audiences()->create(
            Request::validate([
                'facebook_id' => ['required', 'max:50'],
                'odc_id' => ['required', 'max:50'],
                'name' => ['nullable', 'max:300'],
                'type' => ['nullable', 'max:10'],
                'sla' => ['nullable', 'max:25'],
                'estimated_size' => ['nullable', 'max:50'],
                'description' => ['nullable', 'max:500'],
            ])
        );

        return Redirect::route('audiences')->with('success', 'Audience created.');
    }

    public function import()
    {
        return Inertia::render('Audiences/Import', [
            'filters' => Request::all('search', 'trashed')
            ]
        );
    }

    public function runImport(){
        DB::table('audiences')->truncate();
        Excel::import(new AudiencesImport, Request::file('csv'));
        $count = count(DB::select('select * from audiences', [1]));
        return Redirect::route('audiences')->with('success', "Audiences imported. Total Records: {$count}");
    }

    public function edit(Audience $audience)
    {
        return Inertia::render('Audiences/Edit', [
            'audience' => [
                'id' => $audience->id,
                'facebook_id' => $audience->facebook_id,
                'odc_id' => $audience->odc_id,
                'name' => $audience->name,
                'type' => $audience->type,
                'sla' => $audience->sla,
                'estimaged_size' => $audience->estimated_size,
                'description' => $audience->description
            ]
        ]);
    }

//    public function update(Audience $audience)
//    {
//        $audience->update(
//            Request::validate([
//                'first_name' => ['required', 'max:50'],
//                'last_name' => ['required', 'max:50'],
//                'organization_id' => ['nullable', Rule::exists('organizations', 'id')->where(function ($query) {
//                    $query->where('account_id', Auth::user()->account_id);
//                })],
//                'email' => ['nullable', 'max:50', 'email'],
//                'phone' => ['nullable', 'max:50'],
//                'address' => ['nullable', 'max:150'],
//                'city' => ['nullable', 'max:50'],
//                'region' => ['nullable', 'max:50'],
//                'country' => ['nullable', 'max:2'],
//                'postal_code' => ['nullable', 'max:25'],
//            ])
//        );
//
//        return Redirect::route('audiences.edit', $audience)->with('success', 'Audience updated.');
//    }

//    public function destroy(Audience $audience)
//    {
//        $audience->delete();
//
//        return Redirect::route('contacts.edit', $audience)->with('success', 'Contact deleted.');
//    }
//
//    public function restore(Contact $audience)
//    {
//        $audience->restore();
//
//        return Redirect::route('contacts.edit', $audience)->with('success', 'Contact restored.');
//    }
}
