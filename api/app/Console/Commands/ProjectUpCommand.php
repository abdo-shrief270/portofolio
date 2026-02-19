<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class ProjectUpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:up {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bring a project back online';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $slug = $this->argument('slug');
        $project = Project::where('slug', $slug)->first();

        if (!$project) {
            $this->error("Project with slug [{$slug}] not found.");
            return 1;
        }

        $project->update(['is_active' => true]);

        $this->info("Project [{$project->title}] is now ONLINE.");
        
        return 0;
    }
}
