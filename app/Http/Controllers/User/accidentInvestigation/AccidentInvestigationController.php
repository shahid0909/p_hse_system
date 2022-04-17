<?php

namespace App\Http\Controllers\User\accidentInvestigation;

use App\Http\Controllers\Controller;
use App\Models\WhyAnalysis;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function compact;
use function dd;
use function md5;
use function redirect;

class AccidentInvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user = Auth::user();
        return view('dashboards.users.accidentInvestigation.index', compact('user'));
    }

    public function whyWizerd()
    {
        $user = Auth::user();
        return view('dashboards.users.accidentInvestigation.why_wizerd', compact('user'));
    }

    public function whyIncidentHappen()
    {
        $user = Auth::user();
        return view('dashboards.users.accidentInvestigation.why_incident_happen', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'why1' => 'required',
            'why2' => 'required',
            'why3' => 'required',
            'why4' => 'required',
            'why5' => 'required',
            'rootCause' => 'required',
            'reOccurrence' => 'required'
        ]);

        $input = new WhyAnalysis();
        $input->l_employee_id = $request->input('l_employee_id');
        $input->why1 = $request->input('why1');
        $input->why2 = $request->input('why2');
        $input->why3 = $request->input('why3');
        $input->why4 = $request->input('why4');
        $input->why5 = $request->input('why5');
        $input->rootCause = $request->input('rootCause');
        $input->reOccurrence = $request->input('reOccurrence');
        $input->save();

        return redirect()->route('accident_investigation.why_incident_happen')->with('success', 'WHY Analysis Successfully Inserted!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
