@extends('layouts.app')
@section('title')
@endsection
@section('css')
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
    <!-- Body: Body -->
        <div class="card">
            <div class="card-header" style="font-size: 1.3rem"><b>WHY DID THE INCIDENT HAPPEN?</b></div>
            <div class="card-body">
                <table class="display table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Unsafe conditions: (Check all that apply)</th>
                        <th>Unsafe acts: (Check all that apply)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Inadequate guard</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Operating without permission</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Unguarded hazard</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Using the wrong techniques</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">The safety device is defective</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Did not follow SWP</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Tool or equipment defective</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Making a safety device inoperative</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Workstation layout is hazardous</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Using defective equipment</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Unsafe lighting</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Using equipment in an unapproved way</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Unsafe ventilation</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Unsafe lifting by hand</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Lack of needed Personal Protective Equipment</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Wrong posture</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Lack of appropriate equipment/tool</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Distraction, teasing, horseplay</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Unsafe chemical handling</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Failure to wear personal protective equipment</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label"><strong>No training or insufficient training</strong></label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Failure to use the available equipment/tools</label>
                                <input type="checkbox" class="form-check">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Others</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Others</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="d-flex justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Why did the unsafe conditions exist?</label>
                                        <textarea name="" id="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="d-flex justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Why did the unsafe acts occur?</label>
                                        <textarea name="" id="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="d-flex justify-content-between">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Were the unsafe acts or conditions reported prior to the incident?</label>
                                        <input type="radio"> Yes
                                        <input type="radio"> No
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
