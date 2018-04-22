<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Providers\PledgeServiceProvider;
use App\Entities\Pledge;
use DB;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('stats.partials.standard', function ($view) {
            $view->total_pledges = PledgeServiceProvider::getPledge(["year" => date("Y")])->count();
            $view->total_pledges_with_phone = PledgeServiceProvider::getPledge(["withPhoneNr"=>true,"year" => date("Y")])->count();
        });

        View::composer('stats.partials.pledges', function ($view) {
            $view->pledges_signed_up = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y")])->count();
            $view->pledges_signed_up_self = PledgeServiceProvider::getPledge(["status"=>1,"year" => date("Y")])->count();
            $view->pledges_not_going = PledgeServiceProvider::getPledge(["status"=>3,"year" => date("Y")])->count();
            $view->pledges_final_party = PledgeServiceProvider::getPledge(["status"=>4,"year" => date("Y")])->count();
            $view->pledges_diff = PledgeServiceProvider::getPledge(["status"=>5,"year" => date("Y")])->count();
        });

        View::composer('stats.partials.aboutsingups', function ($view) {
            $view->pledges_male = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y"),"sex" => "m"])->count();
            $view->pledges_female = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y"),"sex" => "v"])->count();
            $view->rabo_bicycle = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y"),"rabo_bicycle" => 1])->count();
            $view->vegetarian = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y"),"vegetarian" => 1])->count();
            $view->forward_pay = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y"),"pay_forward" => 1])->count();
            
        });

        View::composer('stats.partials.shirts', function ($view) {
            $return = [];
            $sizes = Config("shirtsize.size");
            foreach($sizes as $size){
                $return["$size"] = 0;
            }

            foreach(PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y")])->groupBy("shirt_size")->select("shirt_size",DB::raw('COUNT(id) as count'))->get()->toArray() as $item) {
                $return[$sizes[$item["shirt_size"]]] = $item["count"];
            }
            $view->shirt_sizes = $return;
            
        });
        
        View::composer('stats.partials.educations', function ($view) {
            $view->educations = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y")])->groupBy("education")->orderBy("education",'asc')->select("education",DB::raw('COUNT(id) as count'))->get()->toArray();
        });

        View::composer('stats.partials.cities', function ($view) {
            $view->cities = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y")])->groupBy("living_place")->orderBy("living_place",'asc')->select("living_place",DB::raw('COUNT(id) as count'))->get()->toArray();
        });
        View::composer('stats.partials.race', function ($view) {
            $view->users_get_pledges = PledgeServiceProvider::getPledge(["status"=>2,"year" => date("Y")])->groupBy("user_id")->orderBy("count",'desc')->select("user_id",DB::raw('COUNT(id) as count'))->with('user')->get();
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}