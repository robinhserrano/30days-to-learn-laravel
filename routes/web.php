<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(10);
    return view('jobs.index', ['jobs' => $jobs]);
});

Route::get('/jobs/create', function () {
    //$job = Job::where('id', $id)->with('employer')->first();
    // dd($job);
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    //$job = Job::find($id)
    $job = Job::where('id', $id)->with('employer')->first();
    // dd($job);
    return view('jobs.show', ['job' => $job]);
});

//Store
Route::post('/jobs', function () {
    request()->validate(
        ['title' => ['required', 'min:3'], 'salary' => ['required']]
    );

    Job::create(['title' => request('title'), 'salary' => request('salary'), 'employer_id' => 1]);
    // dd(request()->all());
    return redirect('/jobs');
});

Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::where('id', $id)->with('employer')->first();
    // dd($job);
    return view('jobs.edit', ['job' => $job]);
});

Route::patch('/jobs/{id}', function ($id) {
    request()->validate(
        ['title' => ['required', 'min:3'], 'salary' => ['required']]
    );

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'), 
        'salary' => request('salary')
    ]);

    return redirect('/jobs/'.$job->id);

    // validate
    // authorize (on hold...)
    // update the job
    // and persist
    // redirect to the job page
});

Route::delete('/jobs/{id}', function ($id) {
 Job::findOrFail($id)->delete();
 return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
