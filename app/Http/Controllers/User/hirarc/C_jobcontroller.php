<?php

namespace App\Http\Controllers\User\hirarc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\I_hirarc;
use App\Models\hazard;
use App\Models\Designation;
use App\Models\l_employee;
use App\Models\Department;
use App\Models\c_job;
use function dd;

class C_jobcontroller extends Controller
{

    public function index()
    {


        $user = Auth::user();
        $department = Department::all();
        $Designation = Designation::all();
        $l_employee = l_employee::all();

        $data = DB::select("SELECT c.*,d.depertment_name from c_jobs c
                            left join departments d on d.id = c.depertment_id");

        return view('dashboards.users.HIRARC.create_job.create_job', compact('user','l_employee','Designation','department','data'));
    }


    public function store(Request $request)

    {
        // dd($request->depertment_id);
        $user = Auth::user();
        $count = $request->job_activity;



        foreach($count as $main=>$row)
        {
            $input1 = new c_job();

            $input1->depertment_id = $request->input('depertment_id');
            if ($imagefile = $request->file('imagefile') [$main])
            {
                $destinationPath = 'image/jobimage';
//                $profileImage = date('YmdHis') . "." . $imagefile->getClientOriginalExtension();
                $profileImage = $imagefile->getClientOriginalName();
                $imagefile->move($destinationPath, $profileImage);


                $input1['image'] = $profileImage;
            }
            $input1->job_activity = $request->job_activity[$main];
            $input1->company_id =$user->company_id;


            $input1->save();

        }
        session()->flash('message','Data has been saved successfully !!');
        return redirect()->back();


    }

    public function destroy($id)

    {

        $c_job = c_job::findOrFail($id);

        if ($c_job)
        {
            $c_job->delete();
            return redirect()->back()->with('success', 'Department information successfully deleted.');
        }

    }



    public function edit($id)
    {
        $user = Auth::user();

        $department=department::all();
        $data = c_job::where('id', $id)->first();

        $data1 = DB::select("SELECT c.*,d.depertment_name from c_jobs c
                            left join departments d on d.id = c.depertment_id");
        return view('dashboards.users.HIRARC.create_job.edit_job', compact('user','department','data','data1'));
    }


    public function update(Request $request,$id)

    {
//         dd($request);
        $user = Auth::user();
        $count = $request->job_activity;


//        foreach($count as $main=>$row)
//        {
            $input1 = c_job::find($id);
            $input1->depertment_id = $request->input('depertment_id');
            if ($imagefile = $request->file('imagefile') )
            {
                $destinationPath = 'image/jobimage';
//                $profileImage = date('YmdHis') . "." . $imagefile->getClientOriginalExtension();
                $profileImage = $imagefile->getClientOriginalName();
                $imagefile->move($destinationPath, $profileImage);
                $input1['image'] = $profileImage;
            }
            $input1->job_activity = $request->job_activity;
            $input1->company_id =$user->company_id;
            $input1->update();
//        }
        $success =  session()->flash('message','Data has been saved successfully !!');
        return redirect()->route('c_job.index')->with('success', 'Data has been updated successfully !!');


    }


    public function listview()
    {


        $user = Auth::user();
        $department = Department::all();

        $job_data = c_job::with('hazard', 'department')
                    ->has('hazard')
                    ->get();

        $seq_job_data = Department::with('hazardData')
//                    ->whereHas('job', function ($query){
//                        $query->where('');
//                    })
                    ->has('hazardData')
                    ->get();

        $job_act_as = hazard::with('c_jobData', 'departmentData')
                    ->has('departmentData')
                    ->get();
//        dd($job_data);

        $job_act = DB::select("SELECT DISTINCT  c.id, h.job_activity_id , c.job_activity, c.depertment_id, d.depertment_name from hazards h LEFT join c_jobs c on c.id = h.job_activity_id LEFT JOIN departments d on d.id = c.depertment_id");
//        dd($job_act);
        $seq_job = [];
        foreach($job_act as $key => $values){
            $seq_job[$key] = DB::select("SELECT c.id, c.job_activity, h.sequence_job from hazards h , c_jobs c WHERE h.job_activity_id = c.id and
h.job_activity_id =".$values->id);
        }
        $data= DB::select("SELECT c.*,h.*,d.depertment_name from hazards c
                            left join departments d on d.id = c.depertment_id
                            left JOIN c_jobs h on h.id =c.job_activity_id");


        return view('dashboards.users.HIRARC.create_job.list_of_activity', compact('user','data','job_act','seq_job','job_data','department'));

    }




    public function droponchange(Request $request,$id)
    {


//        $onchange = I_hirarc::where('depertment_id',$id)->first();
//
        // $onchage1 = c_job::where('hirarc_id',$id)->get();

        // $onchage = DB::select("SELECT h.id,c.job_activity ,h.depertment_id from hazards h
        //         left JOIN c_jobs c on c.id =h.job_activity_id
        //     where h.depertment_id ='$id'");

//        $data = DB::selectOne("SELECT h.id,c.job_activity ,h.depertment_id from hazards h
//            left JOIN c_jobs c on c.id =h.job_activity_id
//        where h.depertment_id ='$id'");

//        $user = Auth::user();
//        $department = Department::all();
//        $job_data = c_job::with('hazard', 'department')
//            ->has('hazard')
//            ->get();
        $data = c_job::with('hazard', 'department')
            ->has('hazard')
            ->whereHas('hazard', function ($query) use ($id) {
                $query->where('depertment_id', '=', $id);
            })
//            ->where('depertment_id','LIKE','%'.$id.'%')
            ->get();

//        $data = hazard::with('c_jobData', 'departmentData')
//            ->has('departmentData')
//            ->where('hazards.depertment_id', '=', $id)
//            ->get();
//        return view('dashboards.users.HIRARC.create_job.list_of_activity', compact('data', 'user', 'department', 'job_data'));
        return response()->json([

            'data'=>$data,

        ], 200);



        // return response()->json($onchage);

        // $stringTosend = '';
        // if (!empty($onchage1))
        // {
        //        $stringTosend .= ' <option value="">--- Choose ---</option>';
        //        foreach ($onchage1 as $data)
        //        {
        //            $stringTosend .="<option  value='".$data->id."'>".$data->job_activity."</option>";


        //        }
        //         echo   $stringTosend;
        // }else{
        //      echo ' <option value="">--- Choose ---</option>';
        // }



    }

}
