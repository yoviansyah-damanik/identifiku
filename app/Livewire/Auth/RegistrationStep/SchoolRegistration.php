<?php

namespace App\Livewire\Auth\RegistrationStep;

use App\Jobs\Mailer;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Rules\PhoneNumber;
use App\Models\SchoolStatus;
use App\Models\SchoolRequest;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class SchoolRegistration extends Component
{
    use LivewireAlert;
    public string $searchProvince = '';
    public string $searchRegency = '';
    public string $searchDistrict = '';
    public string $searchVillage = '';
    public string $searchEducationLevel = '';
    public string $searchSchoolStatus = '';

    public string $npsn = '12345678';
    public string $nis = '123456';
    public string $nss = '123456789012';
    public string $name = 'SMP Negeri 1 Batang Angkola';
    public string $address = 'Tapanuli Selatan';
    // public string $province = '';
    // public string $regency = '';
    // public string $district = '';
    // public string $village = '';
    public string $province = '12';
    public string $regency = '12.77';
    public string $district = '12.77.01';
    public string $village = '12.77.01.1001';
    public string $postalCode = '22222';
    public string $phoneNumber = '081222778197';
    public string|int $educationLevel = 1;
    public string|int $schoolStatus = 1;

    public string $username = 'smp1batangangkola';
    public string $email = 'smp1batangangkola@gmail.com';
    public string $password = '@Password123';
    public string $rePassword = '@Password123';

    public int $step = 1;
    public int $stepMin = 1;
    public int $stepMax = 2;

    public string $successfulMessage;

    public int $maxNpsn = 8;
    public int $maxNss = 12;
    public int $maxNis = 6;

    public bool $isLoading = false;

    public function mount()
    {
        $this->successfulMessage = __('School enrollment was successful. Our team will conduct verification first. The verification results will be sent to the email you have registered.');
    }

    public function render()
    {
        $provinces = Region::province()
            ->where('name', 'like', '%' . $this->searchProvince . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();

        $regencies = Region::when($this->province, fn($q) => $q->regency($this->province), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->searchRegency . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();

        $districts = Region::when($this->regency, fn($q) => $q->district($this->regency), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->searchDistrict . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();

        $villages = Region::when($this->district, fn($q) => $q->village($this->district), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->searchVillage . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();

        $educationLevels = EducationLevel::where('name', 'like', '%' . $this->searchEducationLevel . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->id,
                'title' => $item->name
            ])->toArray();

        $schoolStatuses = SchoolStatus::where('name', 'like', '%' . $this->searchSchoolStatus . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->id,
                'title' => $item->name
            ])->toArray();

        return view('pages.auth.registration-step.school-registration', compact(
            'provinces',
            'regencies',
            'districts',
            'villages',
            'educationLevels',
            'schoolStatuses'
        ))
            ->title(__("Registration"));
    }

    public function rules()
    {
        if ($this->step == 1) {
            return [
                'npsn' => [
                    'required',
                    'string',
                    'digits:' . $this->maxNpsn,
                    'unique:schools,npsn',
                    'unique:school_requests,npsn',
                ],
                'nis' => [
                    'required',
                    'string',
                    'digits:' . $this->maxNis,
                    'unique:schools,nis',
                    'unique:school_requests,nis'
                ],
                'nss' => [
                    'required',
                    'string',
                    'digits:' . $this->maxNss,
                    'unique:schools,nss',
                    'unique:school_requests,nss'
                ],
                'name' => 'required|string|max:60',
                'address' => 'required|string|max:255',
                'province' => 'required|exists:regions,code',
                'regency' => 'required|exists:regions,code',
                'district' => 'required|exists:regions,code',
                'village' => 'required|exists:regions,code',
                'postalCode' => 'required|numeric|digits:5',
                'phoneNumber' => ['required', new PhoneNumber],
                'educationLevel' => 'required|exists:education_levels,id',
                'schoolStatus' => 'required|exists:school_statuses,id',
            ];
        }

        if ($this->step == 2) {
            return [
                'email' => 'required|email:dns|unique:users,email|unique:school_requests,email',
                'username' => 'required|min:8|max:32|alpha_dash|string|unique:users,username|unique:school_requests,username',
                'password' =>   [
                    'required',
                    'string',
                    Password::min(8)->letters()->numbers()->symbols()
                ],
                'rePassword' => 'required|same:password'
            ];
        }
    }

    public function validationAttributes()
    {
        return [
            'npsn' => 'NPSN',
            'nis' => 'NIS',
            'nss' => 'NSS',
            'name' => __(':name Name', ['name' => __('School')]),
            'address' => __('Address'),
            'province' => __('Province'),
            'regency' => __('Regency'),
            'district' => __('District'),
            'village' => __('Village'),
            'postalCode' => __('Postal Code'),
            'phoneNumber' => __('Phone Number'),
            'educationLevel' => __('Education Level'),
            'schoolStatus' => __('School Status'),
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            'rePassword' => __('Re-Password'),
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        DB::beginTransaction();
        try {
            $schoolRequest = SchoolRequest::create([
                'username' => $this->username,
                'password' => bcrypt($this->username),
                'email' => $this->email,
                'npsn' => $this->npsn,
                'nis' => $this->nis,
                'nss' => $this->nss,
                'name' => $this->name,
                'address' => $this->address,
                'postal_code' => $this->postalCode,
                'province_id' => $this->province,
                'regency_id' => $this->regency,
                'district_id' => $this->district,
                'village_id' => $this->village,
                'phone_number' => $this->phoneNumber,
                'education_level_id' => $this->educationLevel,
                'school_status_id' => $this->schoolStatus
            ]);

            $adminEmails = User::role('Administrator')
                ->get('email')->pluck('email')->toArray();

            DB::commit();
            dispatch(new Mailer('school_registration', $adminEmails, $schoolRequest->toArray()));
            $this->step++;
            $this->isLoading = false;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }

    public function setValueProvince($province)
    {
        $this->province = $province;
        $this->reset('regency', 'district', 'village');
        $this->dispatch('resetValueRegency');
        $this->dispatch('resetValueDistrict');
        $this->dispatch('resetValueVillage');
        $this->validateOnly('province');
    }

    public function setValueRegency($regency)
    {
        $this->regency = $regency;
        $this->reset('district',  'village');
        $this->dispatch('resetValueDistrict');
        $this->dispatch('resetValueVillage');
        $this->validateOnly('regency');
    }

    public function setValueDistrict($district)
    {
        $this->district = $district;
        $this->reset('village');
        $this->dispatch('resetValueVillage');
        $this->validateOnly('district');
    }

    public function setValueVillage($village)
    {
        $this->village = $village;
        $this->validateOnly('village');
    }

    public function setValueEducationLevel($educationLevel)
    {
        $this->educationLevel = $educationLevel;
    }

    public function setValueSchoolStatus($schoolStatus)
    {
        $this->schoolStatus = $schoolStatus;
    }

    public function setSearchSearchProvince($data)
    {
        $this->searchProvince = $data;
    }

    public function setSearchSearchRegency($data)
    {
        $this->searchRegency = $data;
    }

    public function setSearchSearchDistrict($data)
    {
        $this->searchDistrict = $data;
    }

    public function setSearchSearchVillage($data)
    {
        $this->searchVillage = $data;
    }

    public function setSearchSearchEducationLevel($data)
    {
        $this->searchEducationLevel = $data;
    }

    public function setSearchSearchSchoolStatus($data)
    {
        $this->searchSchoolStatus = $data;
    }

    public function next()
    {
        $this->validate();

        $isExist = SchoolRequest::where('npsn', $this->npsn)
            ->orWhere('nss', $this->nss)
            ->orWhere('nis', $this->nis)
            ->first();

        if ($isExist) {
            if ($isExist->npsn == $this->npsn) {
                $this->alert('warning', __('The school with :value (:attribute) has been registered.', ['value' => $this->npsn, 'attribute' => 'NPSN']));
            }
            if ($isExist->nss == $this->nss) {
                $this->alert('warning', __('The school with :value (:attribute) has been registered.', ['value' => $this->nss, 'attribute' => 'NSS']));
            }
            if ($isExist->nis == $this->nis) {
                $this->alert('warning', __('The school with :value (:attribute) has been registered.', ['value' => $this->nis, 'attribute' => 'NIS']));
            }
            return;
        }

        if ($this->step < $this->stepMax) $this->step++;
        else $this->step = $this->stepMax;
    }

    public function prev()
    {
        if ($this->step > $this->stepMin) $this->step--;
        else $this->step = $this->stepMin;
    }

    public function resetStep()
    {
        $this->step = $this->stepMin;
    }
}
