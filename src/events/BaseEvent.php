<?php


namespace githooks\events;


use githooks\interfaces\EventInterface;
use githooks\models\GitHooksParameters;
use githooks\traits\MakeTrait;

/**
 * Базовый класс событий
 * Class BaseEvent
 * @package console\modules\githooks\events
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