<?php

namespace App\Http\Controllers;

use App\Mail\reminder;
use App\Models\reservation;
use App\Models\salle;
use Illuminate\Http\Request;
use App\Models\group;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\user_group;
use Illuminate\Support\Facades\Mail;
class ReservationController extends Controller
{

    public  $usersID = [];
    public function salle()
    {
        $salles = salle::all();
        return view("admin.reservations.salle", compact("salles"));
    }
    public function date($id)
    {
        $salleRes = salle::find($id)->reservations()->get();
        $salle = salle::find($id);
        return view("admin.reservations.date", ["salle" => $salle, "salleRes" => $salleRes]);
    }
    public function store(Request $form, $id)
    {
        $form->validate([
            "date"=>['required','date'],
            "start_time"=>['required'],
            "end_time"=>['required'],
            "title"=>["required"]
        ]);
        $dispo = reservation::where("salle_id", "=", $id)->where("date", "=", $form["date"])->exists();



        if ($dispo) {
            $mesg = "Sorry, the time at " . $form["date"] . " start time " . $form["start_time"] . " end time: " . $form["end_time"] . " is reserved";
            $res = reservation::where("salle_id", "=", $id)->where("date", "=", $form["date"])->get();

            $hourSform = intval(substr($form["start_time"], 0, 2));
            $minSform = intval(substr($form["start_time"], 3, 2));
            $hourEform = intval(substr($form["end_time"], 0, 2));
            $minEform = intval(substr($form["end_time"], 3, 2));

            foreach ($res as $r) {
                $hourS = intval(substr($r->start_time, 0, 2));
                $minS = intval(substr($r->start_time, 3, 2));
                $hourE = intval(substr($r->end_time, 0, 2));
                $minE = intval(substr($r->end_time, 3, 2));

                // Check for overlap considering both hours and minutes
                if (($hourS < $hourEform || ($hourS == $hourEform && $minS <= $minEform)) &&
                    ($hourE > $hourSform || ($hourE == $hourSform && $minE >= $minSform))
                ) {                                                  
                    return redirect()->route("reservations.date", $id)->with("message", $mesg);
                }
            }
        }

            $grp = group::create([
                'nom_g' => $form["title"],
                'nb_u' => 1,
                'user_id' => Auth::user()->id,
                'type' => Auth::user()->role=='worker'?"u":"g",
            ]);
            $Res = reservation::create([
                'date' => $form["date"],
                'start_time' => $form["start_time"],
                'end_time' => $form["end_time"],
                'group_id' => $grp->id,
                'salle_id' => $id
            ]);
            return redirect()->route("reservations.date", $id)->with("messageSucces", "save with succes");
        }



        public function show($id){
            $res=reservation::find($id);
            $users=User::all();
            $userGrp=reservation::find($id)->groups->users;

            foreach ($userGrp as $key => $user) {
                $this->usersID[$key] = $user->user_id;
            }
            return view('admin.reservations.show',["res"=>$res,"users"=>$users,"usergrp"=>$userGrp,"userID"=>$this->usersID]);

        }

        public function addUser(Request $form){
            user_group::create([
                'user_id'=>$form["userId"],
                'group_id'=>$form["idGrp"]
            ]);
            $user=User::find($form["userId"])->email;
            $Res=reservation::where("group_id","=",$form["idGrp"])->get()[0];

            Mail::to($user)->send(new reminder($Res->salles->name,$Res->date,$Res->start_time,$Res->end_time));
            return redirect()->back()->with("messageSucces", "add with succes");

        }
        public function exitUser(Request $form){
            user_group::find($form["idExit"])->delete();
            return redirect()->back()->with("messageSucces", "Exit with succes");
        }
        public function deleteRes(Request $form){
            reservation::find($form["idres"])->delete();
            return redirect()->route("reservations.date",$form["idsalle"])->with("messageSucces", "delete with succes");
        }

        public function edit(Request $form,$id){
            $form->validate([
                "date"=>['required','date'],
                "start_time"=>['required'],
                "end_time"=>['required'],
                "title"=>["required"]
            ]);
            $dispo = reservation::where("salle_id", "=", $id)->where("date", "=", $form["date"])->where("id","!=",$id)->exists();



        if ($dispo) {
            $mesg = "Sorry, the time at " . $form["date"] . " start time " . $form["start_time"] . " end time: " . $form["end_time"] . " is reserved";
            $res = reservation::where("salle_id", "=", $id)->where("date", "=", $form["date"])->where("id","!=",$id)->get();

            $hourSform = intval(substr($form["start_time"], 0, 2));
            $minSform = intval(substr($form["start_time"], 3, 2));
            $hourEform = intval(substr($form["end_time"], 0, 2));
            $minEform = intval(substr($form["end_time"], 3, 2));

            foreach ($res as $r) {
                $hourS = intval(substr($r->start_time, 0, 2));
                $minS = intval(substr($r->start_time, 3, 2));
                $hourE = intval(substr($r->end_time, 0, 2));
                $minE = intval(substr($r->end_time, 3, 2));

                // Check for overlap considering both hours and minutes
                if (($hourS < $hourEform || ($hourS == $hourEform && $minS <= $minEform)) &&
                    ($hourE > $hourSform || ($hourE == $hourSform && $minE >= $minSform))
                ) {
                    return redirect()->route("reservations.show", $id)->with("message", $mesg);
                }
            }
        }
            reservation::find($id)->update([
                "date"=>$form["date"],
                "start_time"=>$form["start_time"],
                "end_time"=>$form["end_time"],
            ]);
            group::find($form["idG"])->update([
                "nom_g"=>$form["title"]
            ]);
            return redirect()->route("reservations.show",$id)->with("messageSucces", "update with succes");
        }



    }

