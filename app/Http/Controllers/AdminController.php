<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('doctorimage', $imageName);
        $doctor->image = $imageName;
        $doctor->save();
        return redirect()->back()->with('success', 'doctor added successfully');
    }
    public function storeAppointment(Request $request)
    {
        $appointment = new Appointment();
        $appointment->fullname = $request->fullname;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->doctor = $request->doctor;
        $appointment->message = $request->message;
        $appointment->date = $request->date;
        $appointment->status = 'pending';
        if (Auth::id()) {
            $appointment->user_id = Auth::id();
        } else {
            $appointment->user_id = null;
        }
        $appointment->save();
        return redirect()->back()->with('success', 'Your Appointment has been booked');
    }
}