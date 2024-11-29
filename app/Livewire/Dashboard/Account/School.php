<?php

namespace App\Livewire\Dashboard\Account;

use Livewire\Component;
use App\Rules\PhoneNumber;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Isolate;

#[Isolate]
class School extends Component
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
    public int $maxNpsn = 8;
    public int $maxNss = 12;
    public int $maxNis = 6;

    public bool $isLoading = false;

    public function mount()
    {
        $this->npsn = auth()->user()->school->npsn;
        $this->nis = auth()->user()->school->nis;
        $this->nss = auth()->user()->school->nss;
        $this->name = auth()->user()->school->name;
        $this->address = auth()->user()->school->address;
        $this->province = auth()->user()->school->province_id;
        $this->regency = auth()->user()->school->regency_id;
        $this->district = auth()->user()->school->district_id;
        $this->village = auth()->user()->school->village_id;
        $this->postalCode = auth()->user()->school->postal_code;
        $this->phoneNumber = auth()->user()->school->phone_number;

        $this->educationLevel =  auth()->user()->school->education_level_id;
        $this->schoolStatus =  auth()->user()->school->school_status_id;
    }

    public function render()
    {
        return view('pages.dashboard.account.school');
    }

    public function rules()
    {
        return [
            'npsn' => [
                'required',
                'string',
                'digits:' . $this->maxNpsn,
                'unique:schools,npsn,' . auth()->user()->school->id,
                'unique:school_requests,npsn,' . auth()->user()->school->id,
            ],
            'nis' => [
                'required',
                'string',
                'digits:' . $this->maxNis,
                'unique:schools,nis,' . auth()->user()->school->id,
                'unique:school_requests,nis,' . auth()->user()->school->id
            ],
            'nss' => [
                'required',
                'string',
                'digits:' . $this->maxNss,
                'unique:schools,nss,' . auth()->user()->school->id,
                'unique:school_requests,nss,' . auth()->user()->school->id
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
        try {
            auth()->user()->school->update([
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

            $this->alert('success', __(':attribute updated successfully.', ['attribute' => __('Account')]));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
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
}
