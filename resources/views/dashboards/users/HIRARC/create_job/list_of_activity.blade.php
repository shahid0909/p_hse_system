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

        <div class="body d-flex py-3">
            <div class="container-xxl">
                <!-- Row end  -->
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0"> Activity List</h3>

                        </div>

                        <div class="col-md-4 mb-6">
                            <div class="form-group ">
                                <label class="form-label">
                                    Department
                                    <span class="text-danger">*</span>
                                </label>

                                <!-- <input type="text" class="form-control" required> -->


                                <select name="depertment_id" id="depertment_id" class="col-md-12"
                                        style="padding: 10px; border-radius: 3px; border-color: var(--border-color); border-color:#c0b1b1;">
                                    <option value="">Select Department</option>
                                    @foreach($data as $list)


                                        <option value="{{$list->depertment_id}}">


                                            {{isset($list->depertment_id)? $list->depertment_name: ''}} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="card-body">

                            <table id="myProjectTable" class="table table-hover "

                                   style="width:100%">

                                <thead>

                                <tr>

                                    <th>Sl</th>

                                    <th>Depertment</th>

                                    <th>Job Activity</th>

                                    <th>Sequence</th>

                                    <th>Image</th>

                                    <th>Action</th>


                                </tr>

                                </thead>

                                <tbody>
                                @foreach($job_act as $key=> $act_data)

                                    <tr>
                                        <td style="display:none">{{$act_data->id}}</td>
                                        <td> {{$key+1}}</td>

                                        <td>
                                            {{$act_data->depertment_name}}
                                        </td>
                                        <td>
                                            {{$act_data->job_activity}}
                                        </td>

                                        <td>
                                            @foreach($seq_job as $key=> $data)
                                                @foreach($data as $list)
                                                    <li>
{{--                                                        {{$list->sequence_job}}--}}
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </td>


                                    </tr>
                                @endforeach


                                </tbody>

                            </table>


                        </div>


                    @endsection
                    @section('script')
                        <!--      <script>

            function fun()
            {

                var dept_id = document.getElementById("depertment_id").value;
                document.getElementById("job").innerHTML=
            }
        </script> -->


                            <script>

                                $("#depertment_id").on("change", function () {
                                    let dept_id = $("#depertment_id").val();
                                    $.ajax({
                                        type: 'get',
                                        url: "droponchange" + '/' + dept_id,
                                        success: function (data) {


                                            $('#jobid').val(data.job_activity);

                                        }
                                    });
                                })

                            </script>

                            <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>

                            <!-- Plugin Js-->
                            <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>

                            <!-- Jquery Page Js -->
                            <script src="{{asset('../js/template.js')}}"></script>
                            <script>
                                // project data table
                                $("#employee_id").on("change", function () {
                                    let emp_id = $("#employee_id").val();
                                    $.ajax({
                                        type: 'get',
                                        url: "getempdesignation" + '/' + emp_id,
                                        success: function (data) {


                                            $('#designation').val(data.ds_name);
                                            $('#designation_id').val(data.id);
                                        }
                                    });
                                });

                                $(document).ready(function () {
                                    $('#myProjectTable')
                                        .addClass('nowrap')
                                        .dataTable({
                                            responsive: true,
                                            columnDefs: [
                                                {targets: [-1, -3], className: 'dt-body-right'}
                                            ]
                                        });
                                    $('.deleterow').on('click', function () {
                                        var tablename = $(this).closest('table').DataTable();
                                        tablename
                                            .row($(this)
                                                .parents('tr'))
                                            .remove()
                                            .draw();

                                    });
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

                                    var total = parseInt((likelihood_l + severity_s));

                                    $('#rmn').val(total);
                                }

                                function caltoprice1() {
                                    var likelihood_l1 = parseInt($('#likelihood_l1').val());
                                    var severity_S1 = parseInt($('#severity_S1').val());

                                    var total = parseInt((likelihood_l1 + severity_S1));

                                    $('#rmn1').val(total);
                                }


                            </script>

@endsection


