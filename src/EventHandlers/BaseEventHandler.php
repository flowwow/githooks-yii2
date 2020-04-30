<?php


namespace Flowwow\Githooks\EventHandlers;


use Flowwow\Githooks\Interfaces\EventHandlerInterface;
use Flowwow\Githooks\Models\GitHooksParameters;
use Flowwow\Githooks\Traits\MakeTrait;

/**
 * Базовый класс обработчиков событий
 * Class BaseEventHandler
 * @package Flowwow\Githooks\EventHandlers
 */
abstract class BaseEventHandler implements EventHandlerInterface
{
    use MakeTrait;
    /** @var GitHooksParameters Параметры хуков */
    private $parameters;
    /** @var string Аргументы командной строки */
    protected $arguments;
    /** @var string Коменнтарий к обработчику дял вывода в stdout */
    protected $comment = '';

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
    public function setParameters(GitHooksParameters $parameters): EventHandlerInterface
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return string
     */
    public function getArguments(): string
    {
        return $this->arguments;
    }

    /**
     * @param string $arguments
     * @return static
     */
    public function setArguments(string $arguments): EventHandlerInterface
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return static
     */
    public function setComment(string $comment): EventHandlerInterface
    {
        $this->comment = $comment;

        return $this;
    }
}