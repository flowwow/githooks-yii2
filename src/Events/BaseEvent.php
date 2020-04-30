<?php


namespace Flowwow\Githooks\Events;


use Flowwow\Githooks\Interfaces\EventInterface;
use Flowwow\Githooks\Models\GitHooksParameters;
use Flowwow\Githooks\Traits\MakeTrait;

/**
 * Базовый класс событий
 * Class BaseEvent
 * @package Flowwow\Githooks\Events
 */
abstract class BaseEvent implements EventInterface
{
    use MakeTrait;
    /** @var GitHooksParameters Параметры хуков */
    private $parameters;

    /**
     * BaseEvent constructor.
     * @param GitHooksParameters $parameters
     */
    public function __construct(GitHooksParameters $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return GitHooksParameters
     */
    public function getParameters(): GitHooksParameters
    {
        return $this->parameters;
    }

    /**
     * @param GitHooksParameters $parameters
     * @return static
     */
    public function setParameters(GitHooksParameters $parameters): EventInterface
    {
        $this->parameters = $parameters;

        return $this;
    }

}