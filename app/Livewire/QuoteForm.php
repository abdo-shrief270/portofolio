<?php

namespace App\Livewire;

use App\Models\Quote;
use Livewire\Component;

class QuoteForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $project_type = '';
    public string $budget_range = '';
    public string $message = '';

    public bool $submitted = false;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|max:255',
        'company' => 'nullable|max:255',
        'project_type' => 'nullable|in:website,web_app,mobile_app,e_commerce,api,consulting,other',
        'budget_range' => 'nullable|in:under_1k,1k_5k,5k_10k,10k_25k,25k_plus,not_sure',
        'message' => 'required|min:10|max:2000',
    ];

    public function submit()
    {
        $this->validate();

        Quote::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'project_type' => $this->project_type,
            'budget_range' => $this->budget_range,
            'message' => $this->message,
            'status' => 'new',
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'company', 'project_type', 'budget_range', 'message']);
    }

    public function render()
    {
        return view('livewire.quote-form');
    }
}
