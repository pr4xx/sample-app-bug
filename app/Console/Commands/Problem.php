<?php

namespace App\Console\Commands;

use App\Workflows\ProblemWorkflow;
use Illuminate\Console\Command;
use Workflow\WorkflowStub;

class Workflow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:problem';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the problematic workflow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $workflow = WorkflowStub::make(ProblemWorkflow::class);
        $workflow->start();
        while ($workflow->running());
        $this->info($workflow->output());
    }
}
