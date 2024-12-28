<?php

namespace App\Livewire\Auth\RegistrationStep;

use App\Jobs\Mailer;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use App\Models\SchoolStatus;
use App\Models\SchoolRequest;
use App\Helpers\GeneralHelper;
use App\Models\EducationLevel;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.auth')]
class SchoolRegistration extends Component
{
    use LivewireAlert;

    public array $provinces;
    public array $regencies;
    public array $districts;
    public array $villages;
    public array $educationLevels;
    public array $schoolStatuses;

    public string $provinceSearch = '';
    public string $regencySearch = '';
    public string $districtSearch = '';
    public string $villageSearch = '';
    public string $educationLevelSearch = '';
    public string $schoolStatusSearch = '';

    public string $npsn;
    public string $nis;
    public string $nss;
    public string $name;
    public string $address;
    public string $province = '';
    public string $regency = '';
    public string $district = '';
    public string $village = '';
    public string $postalCode;
    public string $phoneNumber;
    public string|int $educationLevel = 1;
    public string|int $schoolStatus = 1;

    public string $username;
    public string $email;
    public string $password;
    public string $rePassword;

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

        $this->setProvinces();
        $this->setRegencies();
        $this->setDistricts();
        $this->setVillages();
        $this->setEducationLevels();
        $this->setSchoolStatuses();

        if (!GeneralHelper::isProduction()) {
            $this->dev();
        }
    }

    public function dev()
    {
        $this->npsn = '12345678';
        $this->nis = '123456';
        $this->nss = '123456789012';
        $this->name = 'SMP Negeri 1 Batang Angkola';
        $this->address = 'Tapanuli Selatan';
        $this->province = '12';
        $this->regency = '12.77';
        $this->district = '12.77.01';
        $this->village = '12.77.01.1001';
        $this->postalCode = '22222';
        $this->phoneNumber = '081222778197';
        $this->educationLevel = 1;
        $this->schoolStatus = 1;
        $this->username = 'smp1batangangkola';
        $this->email = 'smp1batangangkola@gmail.com';
        $this->password = '@Password123';
        $this->rePassword = '@Password123';
    }

    public function render()
    {
        return view('pages.auth.registration-step.school-registration')
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
                'username' => 'required|min:8|max:32|alpha_dash|string|unique:users,username|unique:teacher_requests,username|unique:student_requests,username',
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
                'username' => Str::lower($this->username),
                'password' => bcrypt($this->password),
                'email' => Str::lower($this->email),
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

            // $adminEmails = User::role('Administrator')
            //     ->get('email')->pluck('email')->toArray();

            DB::commit();
            // dispatch(new Mailer('school_registration', $adminEmails, $schoolRequest->toArray()));
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

    public function setProvinces()
    {
        $this->provinces = Region::province()
            ->where('name', 'like', '%' . $this->provinceSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();
    }

    public function setRegencies()
    {
        $this->regencies = Region::when($this->province, fn($q) => $q->regency($this->province), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->regencySearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();
    }

    public function setDistricts()
    {
        $this->districts = Region::when($this->regency, fn($q) => $q->district($this->regency), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->districtSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();
    }

    public function setVillages()
    {
        $this->villages = Region::when($this->district, fn($q) => $q->village($this->district), fn($q) => $q->whereNull('code'))
            ->where('name', 'like', '%' . $this->villageSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->code,
                'title' => $item->name
            ])->toArray();
    }

    public function setEducationLevels()
    {
        $this->educationLevels = EducationLevel::where('name', 'like', '%' . $this->educationLevelSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->id,
                'title' => $item->name
            ])->toArray();
    }

    public function setSchoolStatuses()
    {
        $this->schoolStatuses = SchoolStatus::where('name', 'like', '%' . $this->schoolStatusSearch . '%')
            ->limit(10)
            ->get()
            ->map(fn($item) => [
                'value' => $item->id,
                'title' => $item->name
            ])->toArray();
    }

    public function setValueProvinceSearch($province)
    {
        $this->province = $province;
        $this->reset('regency', 'district', 'village');
        $this->dispatch('resetValueRegencySearch');
        $this->dispatch('resetValueDistrictSearch');
        $this->dispatch('resetValueVillageSearch');
        $this->validateOnly('province');

        $this->setRegencies();
        $this->setDistricts();
        $this->setVillages();
    }

    public function setValueRegencySearch($regency)
    {
        $this->regency = $regency;
        $this->reset('district',  'village');
        $this->dispatch('resetValueDistrictSearch');
        $this->dispatch('resetValueVillageSearch');
        $this->validateOnly('regency');

        $this->setDistricts();
        $this->setVillages();
    }

    public function setValueDistrictSearch($district)
    {
        $this->district = $district;
        $this->reset('village');
        $this->dispatch('resetValueVillageSearch');
        $this->validateOnly('district');
        $this->setVillages();
    }

    public function setValueVillageSearch($village)
    {
        $this->village = $village;
        $this->validateOnly('village');
    }

    public function setValueEducationLevelSearch($educationLevel)
    {
        $this->educationLevel = $educationLevel;
        $this->validateOnly('educationLevel');
    }

    public function setValueSchoolStatusSearch($schoolStatus)
    {
        $this->schoolStatus = $schoolStatus;
        $this->validateOnly('schoolStatus');
    }

    public function setSearchProvinceSearch($data)
    {
        $this->provinceSearch = $data;
        $this->setProvinces();
    }

    public function setSearchRegencySearch($data)
    {
        $this->regencySearch = $data;
        $this->setRegencies();
    }

    public function setSearchDistrictSearch($data)
    {
        $this->districtSearch = $data;
        $this->setDistricts();
    }

    public function setSearchVillageSearch($data)
    {
        $this->villageSearch = $data;
        $this->setVillages();
    }

    public function setSearchEducationLevelSearch($data)
    {
        $this->educationLevelSearch = $data;
        $this->setEducationLevels();
    }

    public function setSearchSchoolStatusSearch($data)
    {
        $this->schoolStatusSearch = $data;
        $this->setSchoolStatuses();
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
