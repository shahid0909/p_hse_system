@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <style>
        .inpcol {

            outline: 1px solid #5b998d;
        }

        .span {
            content: '*';
            color: red;
        }

        .toast-top-center {
            top: 2rem;
            left: 0%;
            margin: 0 0 0 0;
        }

    </style>
    <!-- Body: Body -->
@endsection
@section('content')
    <!-- sidebar -->
    @include('dashboards.users.partial.sidebar')

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">
        <!-- Body: Header -->
        @include('dashboards.users.partial.header')

         <div>
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">X</button>
                     {{session()->get('success')}}
                     </div>
                    @endif
        </div>


  <div class="body d-flex py-3">
          <div class="container-xxl">
            <!-- Row end  -->
            <div class="col-lg-12">
              <div class="card mb-3">
                  <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h6 class="fw-bold mb-0">Create Hirarc</h6>
                  </div>
                  <div class="card-body">
                    <div class="row align-item-center">
                      <div class="col-md-12">
                         <form method="POST" enctype="multipart/form-data" id="department"

                                      @if(isset($data->id))
                                      action="{{ route('hirarc.update', ['id' => $data->id]) }}">
                                    <input name="_method" type="hidden" value="PUT">
                                    @else
                                        action="{{ route('hirarc.store')}}">
                                    @endif
                                    @csrf
                              <div class="row g-3" style="margin: 0 auto;">
                                  <div class="col-md-4 mb-6">
                                      <div class="form-group">
                                          <label class="form-label">Department</label>
                                          <!-- <input type="text" class="form-control" required> -->

                                          
                                          <select name="depertment_id" id="depertment_id" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Department</option>
                                             @foreach($department as $list)

                                          <option value="{{ $list->id }}" {{ ($list->id == $data->depertment_id) ? 'selected': ''}} >{{ $list->depertment_name }}</option>

                                          @endforeach


                                           <!--  @foreach($data3 as $list)
                                            @if (old('category') == $list->id)
                                                <option value="{{ $list->id }}" selected>{{ $list->depertment_name }}</option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->depertment_name }}</option>
                                            @endif
                                            @endforeach -->
                                          </select>
                                      </div>
                                  </div>
                                

                                     <div class="col-md-4 mb-6">
                                        <div class="form-group">
                                            <label for="validationCustom0001">Process</label>
                                            <div class="input-group">
                                                <input  style=" border-color:#c0b1b1;" type="text" class="form-control" 
                                                id="validationCustom0001" 
                                                name="process" 
                                                value="{{isset($data->process)? $data->process: ''}}"
                                                placeholder="Enter Process"  required>
                                            </div>
                                            </div>
                                        </div>

                                   <div class="col-md-4 mb-6">
                                        <div class="form-group">
                                            <label for="validationCustom0001">Location</label>
                                            <div class="input-group">
                                                <input style=" border-color:#c0b1b1;" 
                                                type="text" 
                                                class="form-control"
                                                 id="validationCustom0001" 
                                                 name="location"
                                                 placeholder="Enter Location"
                                                 value="{{isset($data->location)? $data->location: ''}}"

                                                 required>
                                            </div>
                                            </div>
                                        </div>

                               <div class="col-md-4 mb-6">
                                    <label for="last_assessment" class="form-label">Last Assessment</label>
                                    <input
                                      type="date"
                                      style=" border-color:#c0b1b1;"
                                      class="form-control w-100"
                                      id="last_assessment"
                                      name="last_assessment"
                                      value="{{isset($data->last_assessment)? $data->last_assessment: ''}}"
                                      required
                                    />
                                  </div>


                                 <div class="col-md-4 mb-6">
                                    <label for="assessment_date" class="form-label">Assessment Date/Review Date* </label>
                                    <input
                                      type="date"
                                      style=" border-color:#c0b1b1;"
                                      class="form-control w-100"
                                      id="assessment_date"
                                      name="assessment_date"
                                       value="{{isset($data->assessment_date)? $data->assessment_date: ''}}"

                                      required
                                    />
                                  </div >

                                     <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                        <h6 class="fw-bold mb-0">RM Assessor</h6>
                                    </div> 
                               
                                 
                                        <div class="col-md-4 mb-6">
                                            <label for="depone" class="form-label"
                                            >RM Assessor</label
                                            >
                                            <select  name="rm_assessor" id="rm_assessor" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Employee Name</option>
                                             @foreach($l_employee as $list)

                                          <option value="{{ $list->id }}" {{ ($list->id == $data->rm_assessor) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>
                                        </div>
                                           <div class="col-md-2 mb-6">
                                            <label for="depone" class="form-label"
                                            >RM Team Member 1</label
                                            >
                                            <select   name="rm_member1" id="rm_member1" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Employee</option>
                                             @foreach($l_employee as $list)

                                          <option value="{{ $list->id }}" {{ ($list->id == $data->rm_member1) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>
                                        </div>
                                           <div class="col-md-2 mb-6">
                                            <label for="depone" class="form-label"
                                            >RM Team Member 2</label
                                            >
                                            <select   name="rm_member2" id="rm_member2" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Employee</option>
                                             @foreach($l_employee as $list)

                                          <option value="{{ $list->id }}" {{ ($list->id == $data->rm_member2) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>

                                        </div>
                                           <div class="col-md-2 mb-6">
                                            <label for="depone" class="form-label"
                                            >RM Team Member 3</label
                                            >
                                            <select   name="rm_member3" id="rm_member3" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color);border-color:#c0b1b1;">
                                            <option value="">Select Employee</option>
                                             @foreach($l_employee as $list)

                                          <option value="{{ $list->id }}" {{ ($list->id == $data->rm_member3) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>
                                        </div>

                                         <div class="col-md-2 mb-6">
                                            <label for="depone" class="form-label"
                                            >RM Team Member 4</label
                                            >
                                            <select   name="rm_member4" id="rm_member4" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color);border-color:#c0b1b1;">
                                            <option value="">Select Employee</option>
                                             @foreach($l_employee as $list)

                                         <option value="{{ $list->id }}" {{ ($list->id == $data->rm_member4) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>
                                        </div>


                                  <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                        <h6 class="fw-bold mb-0">Approved by:  </h6>
                                    </div>

                                 <!--  <div class="col-md-4 mb-6">
                                            <label for="depone" class="form-label"
                                            >Signature</label
                                            >
                                            <input type="file"
                                                   style=" border-color:#c0b1b1;"
                                                   class="form-control"
                                                   id="Signature"
                                                   name="Signature"
                                                   value="{{isset($data->Signature)? $data->Signature: ''}}"
                                            />
                                        </div> -->

                                            <div class="col-md-3 mb-6">
                                            <label for="employee_id" class="form-label"
                                            >Name </label
                                            >

                                             <select   
                                             name="employee_id" id="employee_id" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Employee Name</option>
                                             @foreach($l_employee as $list)

                                         <option value="{{ $list->id }}" {{ ($list->id == $data->employee_id) ? 'selected': ''}} >{{ $list->em_name }}</option>

                                          @endforeach
                                          </select>

                                        </div>

                                          <div class="col-md-3 mb-6">
                                            <label for="designation_id" class="form-label"
                                            >Designation</label
                                            >
                                             <select 
                                             
                                             name="designation_id" id="designation_id" class="col-md-12" style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                            <option value="">Select Designation</option>
                                             @foreach($Designation as $list)

                                          < <option value="{{ $list->id }}" {{ ($list->id == $data->designation_id) ? 'selected': ''}} >{{ $list->ds_name }}</option>

                                          @endforeach
                                          </select>
                                           
                                        </div>

                                     
                                       

                                    <div class="col-md-3 mb-6">
                                    <label for="admitdate" class="form-label">Date</label>
                                    <input
                                      type="date"
                                      style=" border-color:#c0b1b1;"
                                      class="form-control w-100"
                                      id="date"
                                      name="date"
                                      value="{{isset($data->date)? $data->date: ''}}"
                                      required
                                    />
                                  </div>   
                             
                                    <div class="col-md-3 mb-6">
                                    <label for="admitdate" class="form-label">Reference no</label>
                                    <input
                                      type="text"
                                      style=" border-color:#c0b1b1;"
                                      class="form-control w-100"
                                      id="reference_no"
                                      name="reference_no"
                                      value="{{isset($data->reference_no)? $data->reference_no: ''}}"
                                      required
                                    />
                                  </div>       

                                    <div  id="show_item">
                                    <div class="row">

                                   
                                           
                                     @foreach($data1 as $key => $values)
                                                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                        <h6 class="fw-bold mb-0">Create Hirarc</h6>
                                    </div>      


                                     <div class="col-md-6 mb-6">
                                            <label for="depone" class="form-label"
                                            >JOB ACTIVITY</label
                                            >
                                            <input type="text"
                                                   style=" border-color:#c0b1b1;"
                                                   class="form-control"
                                                   id="job_activity"
                                                   name="job_activity[]"
                                                   value="{{isset($values->job_activity)? $values->job_activity: ''}}"
                                            />
                                        </div>

                                             <div class="col-md-6 mb-6">
                                                  <label for="formFileMultiple" class="form-label">
                                                 Picture</label
                                                  >
                                                  <input
                                                    class="form-control"
                                                    style=" border-color:#c0b1b1;"
                                                    type="file"
                                                    accept="image/png, image/jpeg,image/jpg"
                                                    id="imagefile"
                                                    name="imagefile[]"
                                                    value="{{isset($values->imagefile)? $values->imagefile: ''}}"

                                                    multiple
                                                    required

                                                  />
                                                 @if(isset($values->id))
                                                <img src="/image/jobimage/{{ $values->image }}" width="10%">@endif

                                                </div>


                                           
                                                @endforeach
                                       

                                             <input type="hidden" name="hirarc_id" id="" class="form-control" value="(data->id)">
                                           <!--  <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary addROw" style="  display: block;
                                                        margin-left: auto;margin-right: 0; margin-top: 10px;">ADD more</button>
                                                </div> -->
                                            </div>

                                        </div>

                                    


                                   <input type="hidden" name="hirarc_id" value="{{$data->id}}" >  
                        
                                  <button type="submit" class="btn btn-primary ">update</button>
                              </div>
                          </form>
                      </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        </div>


        @endsection
        @section('script')
            <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
            .addClass( 'nowrap' )
            .dataTable( {
                responsive: true,
                columnDefs: [
                    { targets: [-1, -3], className: 'dt-body-right' }
                ]
            });
            $('.deleterow').on('click',function(){
            var tablename = $(this).closest('table').DataTable();  
            tablename
                    .row( $(this)
                    .parents('tr') )
                    .remove()
                    .draw();

            } );
        });
   
              $(".addROw").click(function () {
                                            // e.preventDefault();
                                            $("#show_item").prepend(`

                                           <div class="row">

                                          
                                         <div class="col-md-6 mb-6">
                                            <label for="depone" class="form-label"
                                            >
                                           
                                            </label
                                            >
                                            <input type="text"
                                                   style=" border-color:#c0b1b1;"
                                                   class="form-control"
                                                   id="job_activity"
                                                   name="job_activity[]"
                                                   value="{{isset($data->job_activity)? $data->job_activity: ''}}"
                                            />
                                        </div>

                                             <div class="col-md-6 mb-6">
                                                  <label for="formFileMultiple" class="form-label">
                                                 
                                                 
                                                 </label
                                                  >
                                                  <input
                                                    class="form-control"
                                                    style=" border-color:#c0b1b1;"
                                                    type="file"
                                                    id="imagefile"
                                                    name="imagefile[]"
                                                        
                                                   
                                                   
                                                  />
                                                </div>


                                          


                                           <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger rmvROw" style="  display: block;
                                                        margin-left: auto;margin-right: 0;margin-top: 10px;">Remove</button>
                                        </div>
                                            
                                        </div>
                                                </div>`

                                                );
                                            $(document).on('click', '.rmvROw', function (e) {
                                                e.preventDefault();
                                                let row_item = $(this).parent().parent();
                                                $(row_item).remove();
                                            });
                                        });



 function caltoprice() {
            var likelihood_l = parseInt($('#likelihood_l').val());
            var severity_s = parseInt($('#severity_s').val());

            var total =parseInt((likelihood_l+severity_s));
       
            $('#rmn').val(total);
        }

 function caltoprice1() {
            var likelihood_l1 = parseInt($('#likelihood_l1').val());
            var severity_S1 = parseInt($('#severity_S1').val());

            var total =parseInt((likelihood_l1+severity_S1));
       
            $('#rmn1').val(total);
        }



          </script>

@endsection


                               