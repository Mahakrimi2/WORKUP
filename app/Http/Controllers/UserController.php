<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $users = User::all();
        return view('admin.users.show', compact("users"));
    }
    public function store(Request $formulaire)
    {
        $formulaire->validate([
            "nom" => ["required"],
            "email" => ["required", "email","unique:users"],
            "pass" => ["required","min:8"],
            "role" =>["required"]

        ]);
        User::create([
           "name"=>$formulaire["nom"],
           "email"=>$formulaire["email"],
           "password"=>Hash::make($formulaire["pass"]),
           "role"=>$formulaire["role"]

        ]);

        return redirect()->back()->with("message", "save succefully");
    }
    public function delete(Request $req, $id)
    {
        User::where("id", "=", $id)->delete();
        return redirect()->back()->with("message", "deleted succefully");
    }

    public function edit(Request $formulaire, $id)
    {
        $formulaire->validate([
            "nom" => ["required"],
            "email" => ["required", "email"],
            "role" =>["required"]
        ]);

        if($formulaire["pass"]==null){

        User::where("id", "=", $id)->update([
            "name"=>$formulaire["nom"],
            "email"=>$formulaire["email"],
            "role" =>$formulaire["role"]
        ]);
    }
    else{
        User::where("id", "=", $id)->update([
            "name"=>$formulaire["nom"],
            "email"=>$formulaire["email"],
            "password"=>Hash::make($formulaire["pass"]),
            "role" =>$formulaire["role"]

        ]);
    }

        return redirect()->back()->with("message", "edit succefully");
    }
}
