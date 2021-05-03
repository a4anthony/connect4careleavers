<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function all()
    {
        $jobs = Job::latest()->paginate(15)->toArray();
        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
            'pageTitle' => 'Jobs - ' . config('app.name'),
        ]);
    }
}
