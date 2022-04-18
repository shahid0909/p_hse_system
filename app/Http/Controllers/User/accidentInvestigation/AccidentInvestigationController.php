<?php

namespace App\Http\Controllers\User\accidentInvestigation;

use App\Http\Controllers\Controller;
use App\Models\WhyAnalysis;
use App\Models\WhyIncidentHappen;
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

    public function whyIncidentHappenStore(Request $request)
    {
        $input = new WhyIncidentHappen();
        $input->in_guard = $request->input('in_guard');
        $input->operating_permission = $request->input('operating_permission');
        $input->hazard = $request->input('hazard');
        $input->techniques = $request->input('techniques');
        $input->device_defective = $request->input('device_defective');
        $input->swp = $request->input('swp');
        $input->equipment_defective = $request->input('equipment_defective');
        $input->device_inoperative = $request->input('device_inoperative');
        $input->layout_hazardous = $request->input('layout_hazardous');
        $input->defective_equipment = $request->input('defective_equipment');
        $input->unsafe_lighting = $request->input('unsafe_lighting');
        $input->unapproved_way = $request->input('unapproved_way');
        $input->unsafe_ventilation = $request->input('unsafe_ventilation');
        $input->lifting_hand = $request->input('lifting_hand');
        $input->protective_equipment = $request->input('protective_equipment');
        $input->wrong_posture = $request->input('wrong_posture');
        $input->appropriate_equipment = $request->input('appropriate_equipment');
        $input->horseplay = $request->input('horseplay');
        $input->chemical_handling = $request->input('chemical_handling');
        $input->insufficient_training = $request->input('insufficient_training');
        $input->available_equipment = $request->input('available_equipment');
        $input->others1 = $request->input('others1');
        $input->others2 = $request->input('others2');
        $input->unsafe_conditions = $request->input('unsafe_conditions');
        $input->unsafe_acts = $request->input('unsafe_acts');
        $input->prior_incident = $request->input('prior_incident');
        $input->similar_incidents = $request->input('similar_incidents');
        $input->save();

        return redirect()->back()->with('success', 'Incident Happen Successfully Inserted!!');
    }
}
