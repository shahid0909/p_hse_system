<?php

namespace App\Http\Controllers\Admin\AdminA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafetyCommitteeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboards.admins.safetycommittee.index', compact('user'));
    }
}
