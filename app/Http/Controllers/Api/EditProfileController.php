<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{

    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required'  => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique'   => 'This email is already taken.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status'  => 422
            ]);
        }

        try {
            $doctor = Auth::user();

            DB::beginTransaction();

            $imageName = $doctor->image ?? null;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $imageName = "doctor-" . uniqid() . "." . $ext;
                $photo->move(public_path('images/doctors'), $imageName);
            }

            $doctor->update([
                'name'  => $request->name,
                'email' => $request->email,
                'image' => $imageName,
            ]);

            DB::commit();

            return response()->json([
                'status'  => 200,
                'message' => 'Profile updated successfully.',
                'data'    => $doctor
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
