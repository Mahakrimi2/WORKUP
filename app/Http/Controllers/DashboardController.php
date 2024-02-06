<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\salle;
use App\Models\User;
class DashboardController extends Controller

{
    public function dashboardUser(){
        $groups=group::where("user_id","=",Auth::user()->id)->get();
        return view('user.dashboard',compact('groups'));

    }
    public function dashboardAdmin(){
        $salles=salle::all();
        $users=User::all();
        return view('dashboard',compact('salles'),compact('users'));

    }
    public function dashboard(){
        if(Auth::user()->role=='admin'){
            return $this->dashboardAdmin();
        }
        else{
            return $this->dashboardUser();
        }
    }
}
