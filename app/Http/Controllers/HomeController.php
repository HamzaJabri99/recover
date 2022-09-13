<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == '0') {
                $doctors = Doctor::all();
                return view('user.home')->with([
                    'doctors' => $doctors
                ]);
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }
    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $doctors = Doctor::all();
            return view('user.home')->with([
                'doctors' => $doctors
            ]);
        }
    }
    public function myappointments()
    {
        if (Auth::id()) {
            $myAppointments = Appointment::where('user_id', Auth::id())->get();
            return view('user.my_appointments')->with('myAppointments', $myAppointments);
        } else {
            return redirect()->back();
        }
    }
    public function cancelAppointment($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('message', 'canceled Successfuly');
    }
}