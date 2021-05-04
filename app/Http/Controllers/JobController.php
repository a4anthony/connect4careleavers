<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Det all jobs
     *
     *
     * @return \Inertia\Response
     */
    public function all()
    {
        $jobs = Job::latest()->paginate(15)->toArray();
        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
            'pageTitle' => 'Jobs - ' . config('app.name'),
        ]);
    }

    /**
     * Store new jobs
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        Job::create(\request()->all());
        return redirect()->back()->with('success', 'Job/Course added.');

    }

    /**
     * Update jobs
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        Job::find(\request('job_id'))->update(\request()->all());
        return redirect()->back()->with('success', 'Job/Course update.');
    }

    /**
     * Delete jobs
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        Job::find(\request('job_id'))->delete();
        return redirect()->back()->with('success', 'Job/Course deleted.');
    }
}
