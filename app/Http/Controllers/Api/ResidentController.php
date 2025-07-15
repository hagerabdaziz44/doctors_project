<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function get_all_patients(Request $request)
    {
        if ($request->status != 'all') {
            $patients = Patient::where('status', $request->status)->simplePaginate(30);
            return response()->json(['message' => 'success', 'data' => $patients], 200);
        } else {
            $patients =    Patient::simplePaginate(30);
            return response()->json(['message' => 'success', 'data' => $patients], 200);
        }
    }
    public function get_patient_by_id(Request $request)
    {
        $patient =  Patient::where('id', $request->id)->first();
        return response()->json(['message' => 'success', 'data' => $patient], 200);
    }
}
