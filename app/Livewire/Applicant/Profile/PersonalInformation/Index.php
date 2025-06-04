<?php

namespace App\Livewire\Applicant\Profile\PersonalInformation;

use App\Models\AddressBarangay;
use App\Models\AddressCityMunicipality;
use App\Models\City;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\ApplicantProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Locked]
    public $profile_id, $keywork;

    public $profile,  $photo;
    public $firstname, $midname, $surname, $suffix, $contact_number, $birthday, $place_of_birth, $sex, $religion, $civil_status, $employment_status, $introduction,
        $agree;
    public $province, $city, $city_name, $barangay, $barangay_name, $current_province, $current_city, $current_barangay;

    public $intro_id;


    public $sameas, $image;

    public $barangays = [], $cities = [], $specializations = [];


    public function savePersonalInformation()
    {
        try {
            $this->validate([
                'firstname' => 'required',
                'surname' => 'required',
                'midname' => 'nullable',
                'suffix' => 'nullable',
                'province' => 'required',
                'city' => 'required',
                'barangay' => 'required',
                'current_province' => 'nullable',
                'current_city' => 'nullable',
                'current_barangay' => 'nullable',
                'birthday' => 'required',
                'place_of_birth' => 'nullable',
                'sex' => 'required',
                'religion' => 'nullable',
                'civil_status' => 'required',
                'employment_status' => 'required',
                'contact_number' => 'required',
                'introduction' => 'nullable',
            ]);

            if ($this->profile == null) {
                $this->profile = new ApplicantProfile();
                $this->profile->firstname = $this->firstname;
                $this->profile->midname = $this->midname;
                $this->profile->surname = $this->surname;
                $this->profile->suffix = $this->suffix;

                $this->profile->barangay_id = $this->barangay;
                $this->profile->city_id = $this->city;

                $this->profile->current_barangay = $this->current_barangay;
                $this->profile->current_city = $this->current_city;
                $this->profile->current_province = $this->current_province;

                $this->profile->birthday = $this->birthday;
                $this->profile->place_of_birth = $this->place_of_birth;

                $this->profile->sex = $this->sex;
                $this->profile->religion = $this->religion;
                $this->profile->contact_number = $this->contact_number;

                $this->profile->civil_status = $this->civil_status;
                $this->profile->employment_status = $this->employment_status;

                $this->profile->introduction = $this->introduction;

                $this->profile->user_id = Auth::user()->id;
                $this->profile->save();
                $this->updatePhoto();
                $this->dispatch('toggle-offcanvas', id: 'offcanvasPersonalInformation');
            } else {
                $this->profile = ApplicantProfile::where('user_id', Auth::user()->id)->first();
                $this->profile->firstname = $this->firstname;
                $this->profile->midname = $this->midname;
                $this->profile->surname = $this->surname;
                $this->profile->suffix = $this->suffix;

                $this->profile->barangay_id = $this->barangay;
                $this->profile->city_id = $this->city;

                $this->profile->current_barangay = $this->current_barangay;
                $this->profile->current_city = $this->current_city;
                $this->profile->current_province = $this->current_province;

                $this->profile->birthday = $this->birthday;
                $this->profile->place_of_birth = $this->place_of_birth;

                $this->profile->sex = $this->sex;
                $this->profile->religion = $this->religion;
                $this->profile->contact_number = $this->contact_number;

                $this->profile->civil_status = $this->civil_status;
                $this->profile->employment_status = $this->employment_status;

                $this->profile->introduction = $this->introduction;

                $this->profile->user_id = Auth::user()->id;
                $this->profile->save();
                $this->updatePhoto();
                $this->dispatch('toggle-offcanvas', id: 'offcanvasPersonalInformation');

            }
            session()->flash('status', 'Your personal profile has been updated.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ooops, something unexpected happened. Please try again later.');
        }
    }

    public function updatePhoto(){
        try {
            $this->validate([
                'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            ]);

            Auth::user()->updateProfilePhoto($this->photo);

            session()->flash('status', 'Your profile photo has been updated.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Profile picture was not updated.');
        }
    }

    public function getBarangay()
    {
        $this->barangays = AddressBarangay::where('city_municipality_id', '=', $this->city)->orderBy('name')->get();
    }


    public function mount()
    {
        $this->province = "Ilocos Norte";

        $this->cities = AddressCityMunicipality::where('province_id', '=', 1)->orderBy('name')->get();

        $id = Auth::user()->id;

    }


    public function render()
    {

        $this->profile = ApplicantProfile::where('user_id', '=', Auth::user()->id)
            ->with('city')
            ->with('barangay')
            ->with('user')
            ->first();

        if ($this->profile != null) {
            $this->profile_id = $this->profile->id;
            $this->firstname = $this->profile->firstname;
            $this->midname = $this->profile->midname;
            $this->surname = $this->profile->surname;
            $this->suffix = $this->profile->suffix;

            $this->barangay = $this->profile->barangay_id;
            $this->city = $this->profile->city_id;
            $this->getBarangay();

            $this->current_barangay = $this->profile->current_barangay;
            $this->current_city = $this->profile->current_city;
            $this->current_province = $this->profile->current_province;

            $this->birthday = $this->profile->birthday;
            $this->place_of_birth = $this->profile->place_of_birth;

            $this->sex = $this->profile->sex;
            $this->religion = $this->profile->religion;
            $this->contact_number = $this->profile->contact_number;

            $this->civil_status = $this->profile->civil_status;
            $this->employment_status = $this->profile->employment_status;

            $this->introduction = $this->profile->introduction;
        }

        $this->keywork = $this->profile_id . 'workexperience';

        return view('livewire.applicant.profile.personal-information.index');
    }
}
