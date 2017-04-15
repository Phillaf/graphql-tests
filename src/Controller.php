<?php

namespace App;

use App\Auth\User;
use Youshido\GraphQL\Execution\Processor;

class Controller
{
    private $processor;

    public function __construct(Processor $processor, User $user)
    {
        $processor
            ->getExecutionContext()
            ->getContainer()
            ->set('user', $user);

        $this->processor = $processor;
    }

    public function execute(string $query, array $variables)
    {
        $this->processor->processPayload($query, $variables);
        return $this->processor->getResponseData();
    }
}
