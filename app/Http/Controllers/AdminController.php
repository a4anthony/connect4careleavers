<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function all()
    {
        return Inertia::render('Admin/Dashboard', [
            'pageTitle' => 'Dashboard - ' . config('app.name'),
        ]);
    }
}
