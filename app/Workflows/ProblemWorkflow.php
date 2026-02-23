<?php

namespace App\Workflows;

use Workflow\SignalMethod;
use Workflow\Workflow;
use function Workflow\activity;
use function Workflow\await;
use function Workflow\awaitWithTimeout;
use function Workflow\child;
use function Workflow\sideEffect;
use function Workflow\timer;

class ProblemWorkflow extends Workflow
{
    public function execute()
    {
        $result = yield awaitWithTimeout('3 seconds', fn() => false);

        logger()->info(json_encode($result));

        if ($result) {
            logger()->info('This should never be executed!');
        } else {
            // ignore timeout
        }

        yield activity(LogActivity::class, 'This message should only appear once.');
        yield activity(LogActivity::class, 'Another message that should only appear once.');

        return "end";
    }
}
