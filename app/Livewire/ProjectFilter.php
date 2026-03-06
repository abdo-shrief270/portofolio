<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\TechStack;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectFilter extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selectedTechStacks = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedTechStacks' => ['except' => [], 'as' => 'tech'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedTechStacks()
    {
        $this->resetPage();
    }

    public function toggleTechStack(int $id)
    {
        if (in_array($id, $this->selectedTechStacks)) {
            $this->selectedTechStacks = array_values(array_diff($this->selectedTechStacks, [$id]));
        } else {
            $this->selectedTechStacks[] = $id;
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedTechStacks = [];
        $this->resetPage();
    }

    public function render()
    {
        $projects = Project::query()
            ->published()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('client_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedTechStacks, function ($query) {
                $query->whereHas('techStacks', function ($q) {
                    $q->whereIn('tech_stacks.id', $this->selectedTechStacks);
                });
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(9);

        $techStacks = TechStack::orderBy('sort_order')->get();

        return view('livewire.project-filter', [
            'projects' => $projects,
            'techStacks' => $techStacks,
        ]);
    }
}
