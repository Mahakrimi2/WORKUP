<?php

namespace App\Http\Controllers;

use App\Models\salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalleController extends Controller
{
    public function show()
    {
        $salles = salle::all();
        return view('admin.salles.show', compact("salles"));
    }
    public function store(Request $formulaire)
    {
        $formulaire->validate([
            "nom" => ["required"],
            "num" => ["required", "integer"],
            "img" => ["required", "image", "max:1024", "mimes:png,jpg"],

        ]);
        if ($formulaire->file("img")) { //verifier user send file with name input img
            $file = $formulaire->file('img'); //make variable for file
            $filename = date('YmdHi') . $file->getClientOriginalName(); //make name unique for this file  ex:01-12-2023+image name
            //$file-> move(public_path('public/Image'), $filename);
            $file->storeAs("image", $filename, "public"); //storage/app/public/image
        }
        salle::create([
            'name' => $formulaire["nom"],
            'number_u' => $formulaire["num"],
            'image_path' => "storage/image/" . $filename, //make storage/image/filename
            'desc' => $formulaire["desc"]
        ]);
        return redirect()->back()->with("message", "save succefully");
    }


    public function delete(Request $req, $id)
    {
        salle::where("id", "=", $id)->delete();
        return redirect()->back()->with("message", "deleted succefully");
    }


    public function edit(Request $formulaire, $id)
    {
        $formulaire->validate([
            "nom" => ["required"],
            "num" => ["required", "integer"],
        ]);

        $pathimg = salle::find($id)->image_path; //storage/image/filename.png

        $filename = substr($pathimg, 14, strlen($pathimg) - 1); //filename.png
        if ($formulaire->file("img")) {
            $file = $formulaire->file('img');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            //$file-> move(public_path('public/Image'), $filename);
            $file->storeAs("image", $filename, "public");

            $oldimg = "public/" . substr($pathimg, 8, strlen($pathimg) - 1); //public/image/filename.png

            if (Storage::exists($oldimg)) {
                Storage::delete($oldimg);
                /*
                    Delete Multiple files this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }
        }

        salle::where("id", "=", $id)->update([
            'name' => $formulaire["nom"],
            'number_u' => $formulaire["num"],
            'image_path' => "storage/image/" . $filename,
            'desc' => $formulaire["desc"]
        ]);
        return redirect()->back()->with("message", "edit succefully");
    }
}
