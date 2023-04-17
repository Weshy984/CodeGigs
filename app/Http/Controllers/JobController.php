<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Faker\Provider\Lorem;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    //shows all jobs
    public function index()
    {
        return view('jobs.index',[
            'jobs' => Job::latest()->filter(request(['tag','search']))->paginate(5)
        ]);    
    }
    //shows one job
    public function show(Job $job)
    {
        return view('jobs.show',[
            'job' => $job
        ]); 
    }
    //show create form
    public function create(){
        return view('jobs.create');
    }
    //store gig posting
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' =>['required',Rule::unique('jobs','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Job::create($formFields);

    
        return redirect('/')->with('message','The job has been saved');
    }
    //edit gigs form
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }
    //update a gig
    public function update(Request $request, Job $job)
    {
        //logic to certify logged in user is the owner of the gig
        if ($job->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' =>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $job->update($formFields);

    
        return back()->with('message','The gig has been updated');
    }
    //delete a gig
    public function delete(Job $job)
    {
        //logic to certify logged in user is the owner of the gig
        if ($job->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $job->delete();
        return redirect('/')->with('message','This gig is deleted');
    }
    //managing a gig
    public function manage()
    {
        return view('jobs.manage',['jobs' => auth()->user()->jobs()->get()]);
    }
}