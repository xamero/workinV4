<?php

namespace App\Livewire\Dashboard;

use App\Models\Company;
use App\Models\RecruitmentActivity;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{


    public function render()
    {
//        $activities = RecruitmentActivity::limit(5)->get();

       $activities = 
        DB::table('recruitment_activities')
            ->select(
                'recruitment_activities.id',
                'type',
                'start',
                'end',
                'venue',
                'details',
                DB::raw('GROUP_CONCAT(companies.name SEPARATOR ", ") as related_companies')
            )
            ->join('company_recruitment_activity', 'recruitment_activities.id', '=', 'company_recruitment_activity.recruitment_activity_id')
            ->join('companies', 'company_recruitment_activity.company_id', '=', 'companies.id')
            ->groupBy('recruitment_activities.id', 'type', 'start', 'end', 'venue', 'details')->limit(4)->get();;


        if (auth()->check()) {
            $session = DB::table('sessions')
                ->where('user_id', auth()->id())
                ->latest('last_activity') // or 'created_at', 'updated_at'
                ->first('id');
        }

        $companies = Company::orderByRaw('logo IS NULL')
            ->orderBy('name') // optional: secondary sort
            ->get();

        return view('livewire.dashboard.index', ['activities' => $activities, 'user_session' => $session, 'companies' => $companies]);;
    }
}
