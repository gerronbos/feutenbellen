<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Pledge;
use App\Providers\PledgeServiceProvider;
use App\Http\Resources\PledgeCollection;
use App\Http\Resources\Pledge as PledgeResource;
use App\Http\Requests\SingupRequest;

class PledgeController extends Controller
{
    public function getIndex(){
        $view = view('pledges.index');
        $view->status = Config("status.pledge");
        $view->could_dups = PledgeServiceProvider::getDups()->count();
        
        return $view;
    }

    public function getPledges(Request $request){

        $pledges = PledgeServiceProvider::getPledge(["year" => date("Y"),"status"=>$request->input("status_id")])->orderBy("updated_at",'desc');

        return new PledgeCollection($pledges->paginate("25"));
    }

    public function getImport(){
        $view = view("pledges.import");
        $view->fields = Config("import.fields");

        return $view;
    }
    public function postImport(Request $request){
        $path = $request->file('file')->store("imports");

        $file = fopen(storage_path("app/".$path), "r");
        $first = 0;

        while ( ($dataarray = fgetcsv($file, 200, ",")) !==FALSE ){
                if($first != 0){
                    if(str_contains($dataarray[0],";")){
                        $data = explode(";",$dataarray[0]);
                    }
                    else{
                        $data = $dataarray;
                    }

                    PledgeServiceProvider::importUser($data,$request->input("fields"),$request->input("own_fields"),$request->input("own_fields_input"));
                }
                else{
                    $first = 1;
                }
         }
         fclose($file);
         return redirect()->route('pledges')->with(["msg" => "Import succesvol gelukt!","msg_type"=>"success"]);
    }

    public function getDups(){
        $view = view("pledges.dups.index");
        $view->dups = PledgeServiceProvider::getDups()->get();

        return $view;

    }

    public function getPledge($pledge_id){
        $pledge = Pledge::find($pledge_id);

        return new PledgeResource($pledge);
    }

    public function setDupStatus($pledge_id,$status){
        $pledge = Pledge::find($pledge_id);
        if($status){
            $pledge->status = 6;
            $pledge->save();
        }
        else{
            $pledge->could_dup = 0;
            $pledge->dup_id = NULL;
            $pledge->save();
        }

        return redirect()->route("pledges.dups");
    }

    public function getEdit($pledge){
        $pledge = Pledge::find($pledge);
        $view = view("pledges.edit");
        $view->pledge = $pledge;
        $studies = Config("education.studies");
        $view->studies = array_sort($studies);
        $view->education_types = Config("education.types");
        $view->shirt_sizes = Config("shirtsize.size");
        $view->statusChangeEnabled = true;
        $view->status = Config("status.pledge");
        return $view;
    }

    public function postEdit(SingupRequest $request,$pledge){
        $pledge = Pledge::find($pledge);

        PledgeServiceProvider::editUser($pledge,$request->toArray());

        return redirect()->route('call.show',[$pledge->id])->with(["msg" => 'Feut gewijzigd','msg_type' => 'success']);

    }
}
