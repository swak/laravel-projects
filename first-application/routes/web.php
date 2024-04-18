<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(5);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function() {
    // dd(request()->all());
    // validation...
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (on hold)
    // update job
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    // and persist
    // redirect to the job page
    return redirect('/jobs/' . $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize (on hold)
    // delete the job
    $job = Job::findOrFail($id);
    $job->delete();
    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});