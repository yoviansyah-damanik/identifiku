<?php

namespace App\Livewire\Auth\RegistrationStep;

use App\Models\School;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.auth')]
class StudentRegistration extends Component
{
    use LivewireAlert;

    public string $token;
    public string $school;
    public bool $isLoading = false;

    public string $schoolSearch = '';

    public function render()
    {
        $schools = School::where('name', 'like', '%' . $this->schoolSearch . '%')
            ->where('is_active', true)
            ->limit(10)
            ->get()
            ->map(fn($school) => [
                'title' => $school->name,
                'value' => $school->id,
                'description' => $school->fullAddress,
                'badge' => [
                    'title' => $school->is_open ? __('Open') : __('Close'),
                    'type' => $school->is_open ? 'success' : 'error'
                ]
            ])
            ->toArray();

        return view('pages.auth.registration-step.student-registration', compact('schools'))
            ->title(__('Register'));
    }

    public function rules()
    {
        return [
            'school' => 'required|exists:schools,id',
            'token' => 'required|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'school' => __('School')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function setValueSchool($data)
    {
        $this->school = $data;
    }

    public function setSearchSchoolSearch($data)
    {
        $this->schoolSearch = $data;
    }

    public function submit()
    {
        $this->validate();
        $this->isLoading = true;
        try {
            $school = School::where('id', $this->school)
                ->where('token', $this->token)->first();

            if ($school) {
                if (!$school->is_open) {
                    $this->alert('warning', __('The selected school cannot add students. Please contact the School Administator for more details.'));
                    $this->isLoading = false;
                    return;
                }

                return $this->redirectRoute('registration.student.final', ['school' => $this->school, 'token' => $this->token], navigate: true);
            }

            $this->alert('warning', __('Schools and tokens are incompatible.'));
            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        } catch (\Throwable $e) {
            $this->isLoading = false;
            $this->alert('warning', $e->getMessage());
        }
    }
}
