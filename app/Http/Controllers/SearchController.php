<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $query = \request('query');
        //
        $results = User::where('username', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')->limit(7)->get()->toArray();

        return response()->json(['results' => $results]);
        //dd($results);
        //dd('here');
        //return redirect()->back();

    }
}
