<?php

namespace App\Workflows;

use Workflow\Activity;

class LogActivity extends Activity
{
    public function execute($message)
    {
        logger()->info($message);
    }
}
