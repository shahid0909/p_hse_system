@extends('layouts.app')
@section('title')
    Meeting
@endsection
@section('style')
<style type="text/css">
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

    <!-- sidebar -->
    @include('dashboards.users.partial.sidebar')

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">
        <!-- Body: Header -->
        @include('dashboards.users.partial.header')

        @if ($message = Session::get('success'))
            <div class="alert alert-success message">
                <p>{{ $message }}</p>
            </div>
        @endif

        <h3 class="bg bg-success text-center text-white p-3">Meeting Minutes</h3>
        <form method="post"  enctype="multipart/form-data"

            @if(isset($data->id))
            action="{{ route('meeting.meeting-update', ['id' => $data->id]) }}">
          <input name="_method" type="hidden" value="PUT">
          @else
          action="{{ route('meeting.store') }}">
          @endif
            @csrf
            <input type="hidden" name="meeting_id">
            <div class="row g-3 mb-3">


                <label >Company Name</label>
                <input name="company_name" id="" class="form-control" value="{{ $companies->company_name }}" readonly>



                <input type="hidden" name="company_id" id="" class="form-control" value="{{ $companies->id }}">



                <div class="col-sm-4">
                    <label class="form-label">Enter Meeting Date</label>
                  <input type="date"  name="meeting_date" class="form-control" value="{{isset($data->meeting_date) ? $data->meeting_date:''}}">
                </div>

                <div class="col-sm-4">
                    <label class="form-label">Enter Meeting Time</label>
                  <input type="time"  name="time" class="form-control"  value="{{isset($data->time) ? $data->time:''}}">
                </div>

                <div class="col-sm-4">
                    <label class="form-label">Enter Meeting Venue</label>
                  <input type="text" placeholder="Enter Meeting Venue" name="venue" class="form-control" value="{{isset($data->venue) ? $data->venue:''}}">
                </div>


                {{-- <option value="{{ $list->id }}" {{ ($list->id == $data->job_activity_id) ? 'selected': ''}} >{{ $list->job_activity }}</option> --}}


                <div class="multiselect">
                    <h5>Check Present Member</h5>
                    <div id="checkboxes">

                        {{-- @foreach ($ppe as $pp)
                        <label>
                            <input type="checkbox" name="ppe_name[]" value="{{ $pp->ppeName  }}" @if (isset($data->id))
                            @foreach ($c_data as $v)
                            {{ ($pp->ppeName==$v->ppe) ? 'checked':''}}
                            @endforeach
                            @endif  />{{ $pp->ppeName }}</label> --}}


                        @foreach ($values as $value)
                        <label>
                            <input type="checkbox" name="p_member[]" value="{{ $value-> em_name }}"

                            @if (isset($data->id))

                          @foreach ($data2 as $dat)
                            {{ $value->em_name==$dat->p_member ? 'checked' : '' }}
                            @endforeach

                        @endif


                             /><span style="margin:0px 10px;font-size:17px;font-weight:700">
                                {{ $value->em_name }}--{{ $value->designation}}</span></label>
                        @endforeach
                    </div>
                  </div>

                  {{-- <div class="multiselect">
                    <h5>Check Present Member</h5>
                    <div id="checkboxes">
                        @foreach ($values as $value)
                        <label>
                            <input type="checkbox" name="p_member[]" value="{{ $value-> em_name }}"/><span style="margin:0px 10px;font-size:17px;font-weight:700">
                                {{ $value->em_name }}--{{ $value->designation}}</span></label>
                        @endforeach
                    </div>
                  </div>  --}}





                {{-- @else
                <div class="multiselect">
                    <h5>Check Present Member</h5>
                    <div id="checkboxes">
                        @foreach ($values as $value)
                        <label>
                            <input type="checkbox" name="p_member" value="{{ $value->id  }}" /><span style="margin:0px 10px;font-size:17px;font-weight:700">
                                {{ $value->em_name }}--{{ $value->designation}}</span></label>
                        @endforeach
                    </div>
                  </div>
                @endif --}}
                <div class="col-sm-12">
                    <label class="form-label"> Meeting introduction</label>
                   <textarea name="introduction"  cols="80"  id="summernote"  class="form-control">

                       {{ (isset($data->introduction)?$data->introduction:'') }}


                  </textarea>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">ENDORSEMENT OF THE PREVIOUS MEETING MINUTES </label>
                   <textarea name="endorsement" id="summernote1" cols="80" class="form-control">{{isset($data->endorsement) ? $data->endorsement:''}}</textarea>
                </div>
                <table class="table table-bordered" id="dynamicAddRemove">
                    <thead>
                     <tr>
                         <th>Agenda Type</th>
                         <th>Agenda</th>
                         <th>Pic</th>
                         <th>Remarks</th>

                     </tr>
                    </thead>
                    <tbody>
                        @if (isset($data->id))
                        @foreach ($data1 as $dats)
                        <tr id="tr">
                            <td><select type="text" name="agenda_type[]"  class="form-control" >
                                    <option value="1">Others</option>
                                    <option value="2">Incedence</option>
                                    <option value="3">Work Inspection</option>
                                </select>
                            </td>
                            <td><input type="text" name="agenda[]" placeholder="Enter agenda" class="form-control"  value="{{ isset($dats->agenda) ? $dats->agenda:''}}">
                            </td>
                            <td><select type="text" name="incdence_no[]">
                                    <option value="">---Choose---</option>
                                    @foreach($accidence as $list)
                                        <option value="{{$list->inc_number}}">{{$list->inc_number}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="display: none" class="inspection">
                                <select name="inspection[]" id="inspection" class="form-control">
                                    <option value="">---Choose---</option>
                                </select>
                            </td>
                            <td><input type="text" name="pic[]" placeholder="Enter pic" class="form-control"  value="{{ isset($dats->pic) ? $dats->pic:''}}"  />
                            </td>
                            <td><input type="text" name="remarks[]" placeholder="Enter Remarks" class="form-control"  value="{{ isset($dats->remarks) ? $dats->remarks:''}}"  />
                            </td>
                            <td><button type="button" name="add" id="add_btn" class="btn btn-outline-primary">Add More</button></td>
                        </tr>
                        @endforeach
                        @else
                        <tr id="tr">
                            <td><select type="text" name="agenda_type[]"  id="agenda_type" class="form-control agenda_type" >
                                    <option value="1">Others</option>
                                    <option value="2">Incedence</option>
                                    <option value="3">Work Inspection</option>
                                </select>
                            </td>
                            <td class="agenda_other">
                                <input type="text" name="agenda[]" placeholder="Enter agenda" class="form-control "  >
                            </td>
                            <td style="display: none" class="incedence">
                                <select type="text" name="incdence_no[]" class="form-control " >
                                    <option value="">---Choose---</option>
                                    @foreach($accidence as $list)
                                        <option value="{{$list->inc_number}}">{{$list->inc_number}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="display: none" class="inspection"><select type="text" name="inspection[]" class="form-control " >
                                    <option value="">---Choose---</option>
                                    @foreach($inspection as $list)
                                        <option value="{{$list->id}}">{{$list->inspection_title}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" name="pic[]" placeholder="Enter pic" class="form-control"  />
                            </td>
                            <td><input type="text" name="remarks[]" placeholder="Enter Remarks" class="form-control"   />
                            </td>
                            <td><button type="button" name="add" id="add_btn" class="btn btn-outline-primary">Add More</button></td>
                        </tr>

                        @endif


                    </tbody>

                 </table>


                <div class="col-sm-12">
                    <label class="form-label">CLOSING</label>
                   <textarea name="closing" id="summernote2">{{ isset($data->closing) ? $data->closing:''}}</textarea>
                </div>


                @if (isset($data->id))
                <div class="col-sm-12">
                    <button type="submit" >Update</button>
                </div>
                @else
                <div class="col-sm-12">
                    <button type="submit" >Submit</button>
                </div>
                @endif
            </div>
        </form>

        @if (isset($data->id))
        @else
        <div class="container">
            <h1 class=" text-center">Meeting Report</h1>
            <div class="row ">
                <div class="col-md-12">
                   <div class="row "  style="border-bottom: 2px solid black;border-top: 2px solid black">
                       <div class="col-md-3  bg bg-info  text-center  p-2">
                          Date
                       </div>
                       <div class="col-md-3  bg bg-info text-center  p-2">
                        Time
                       </div>
                       <div class="col-md-3  bg bg-info text-center p-2">
                         Venue
                       </div>
                       <div class="col-md-3  bg bg-info text-center p-2">
                         Action
                       </div>

                   </div>
                </div>

            </div>


          <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($s_values as $v)
                <div class="col-md-3  text-center  p-2">
                    {{ $v->meeting_date }}
                 </div>
                 <div class="col-md-3  text-center  p-2">
                 {{ $v->time}}
                 </div>
                 <div class="col-md-3  text-center p-2">
                  {{ $v->venue }}
                 </div>
                 <div class="col-md-3  text-center  p-2">
                    <a href="{{ route('meeting.report', $v->id )}}">
                        <button class="bg bg-info">view Details</button>
                    </a>
                    <a href="{{ route('meeting.meeting-edit', $v->id )}}">
                        <button class="bg bg-info">Edit</button>
                    </a>
                    <a href="{{ route('meeting.delete',$v->id) }}">
                        <button class="bg bg-danger">Delete</button>
                    </a>

                 </div>
                @endforeach

                </div>

            </div>

            <!-- Row End -->
        </div>

          @endif
        </div>


    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        $(document).ready(function() {
            $('#summernote1').summernote();
        });
        $(document).ready(function() {
            $('#summernote2').summernote();
        });
    </script>
   <script type="text/javascript">

   $(document).ready(function(){
       // let rand = Random();
       $(document).on('change', '.agenda_type_add', function () {
           let agenda_type = $(this).val();
           $.ajax({
               url: "{{ route('meeting.getData') }}",
               type: "POST",
               data : {"_token":"{{ csrf_token() }}"},
               dataType: "json",
               success: function (dataResult) {
                   let accidence = dataResult.accidence
                   let inspection = dataResult.inspection
                   let accidence_res = '';
                   let inspection_res = '';
                   console.log(dataResult.inspection)
                   $.each(accidence, function (key, val) {
                       // console.log(val)
                       // $('.incedenceo1').append('');
                       accidence_res += '<option value="'+val.id+'">'+val.inc_number+'</option>'
                   });
                   $.each(inspection, function (key, val) {
                       // console.log(val)
                       // $('.inspectiono1').append('');
                       inspection_res += '<option value="'+val.id+'">'+val.inspection_title+'</option>'
                   });

                   $('.incedenceo1').html(accidence_res);
                   $('.inspectiono1').html(inspection_res);
               }
           });

           if (agenda_type == 1) {
               $(".agenda_other1").css("display", "block");
               $(".incedence1").css("display", "none");
               $(".inspection1").css("display", "none");
           }else if(agenda_type == 2){
               $(".agenda_other1").css("display", "none");
               $(".inspection1").css("display", "none");
               $(".incedence1").css("display", "block");
           }else{
               $(".agenda_other1").css("display", "none");
               $(".incedence1").css("display", "none");
               $(".inspection1").css("display", "block");

           }
       });

       function Random() {
           return Math.floor(Math.random() * 100);
       }

       // function randomValue() {
       //     document.getElementById('tb').value = Random();
       // }

    $("#add_btn").on('click',function () {
        // console.log(rand);
        let html=' ';
        html+=''
        html+='<tr>';
        html+='<td><select type="text" name="agenda_type[]"  class="form-control agenda_type_add" ><option value="1">Others</option><option value="2">Incedence</option><option value="3">Work Inspection</option></select></td>';
        html+='<td class="agenda_other1"><input type="text" name="agenda[]" placeholder="Enter agenda" class="form-control "  >';
        html+='<td style="display: none" class="incedence1"><select type="text" name="incdence_no[]"  class="form-control incedenceo1" ><option value="">---Choose---</option></select></td>';
        html+='<td style="display: none" class="inspection1"><select type="text" name="inspection_no[]"  class="form-control inspectiono1" ><option value="">---Choose---</option></select></td>';
        html+='<td><input type="text" name="pic[]" class="form-control"/></td>';
        html+='<td><input type="text" name="remarks[]" class="form-control"/></td>';
        html+='<td><button type="button" class="btn btn-primary" id="remove" >Remove</button></td>';
        html+='</tr>';
        $('tbody').append(html);
    })
   });
   $(document).on('click','#remove',function(){
      $(this).closest('tr').remove();
   });

   $(document).on('change', '.agenda_type', function () {
       let agenda_type = $(this).val();

       if (agenda_type == 1) {
           $(".agenda_other").css("display", "block");
           $(".incedence").css("display", "none");
           $(".inspection").css("display", "none");
       }else if(agenda_type == 2){
           $(".agenda_other").css("display", "none");
           $(".inspection").css("display", "none");
           $(".incedence").css("display", "block");
       }else{
           $(".agenda_other").css("display", "none");
           $(".incedence").css("display", "none");
           $(".inspection").css("display", "block");

       }
   });

</script>
        <!-- Row End -->
    </div>
@endsection
