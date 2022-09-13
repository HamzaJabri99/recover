<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function addView()
    {
        return view('admin.add_doctor');
    }
    public function storeDoctor(Request $request)
    {
        // Doctor::create([
        //     'name' => $request->name,
        //     'phone' => $request->phone
        // ]);
        $request->validate([
            'name' => 'required|unique:doctors,name|max:15',
            'phone' => 'required|unique:doctors,phone|numeric',
            'image' => 'required|max:2000'
        ]);
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $image = $request->image;
        $imageName = time() . '_' . $image->getClientOriginalExtension();
        $request->image->move('doctorimage', $imageName);
        $doctor->image = $imageName;
        $doctor->save();
        return redirect()->back()->with('success', 'doctor added successfully');
    }
}