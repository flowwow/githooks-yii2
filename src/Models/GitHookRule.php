<?php


namespace Flowwow\Githooks\Models;


use Flowwow\Githooks\Interfaces\EventHandlerInterface;
use Flowwow\Githooks\Interfaces\EventInterface;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Описывает правило для событий хуков
 * Class GitHookRule
 * @package Flowwow\Githooks\Models
 */
class GitHookRule extends BaseObject
{
    /** @var string Название хука */
    private $hook;
    /** @var EventInterface Событие */
    private $event;
    /** @var EventHandlerInterface Обработчик события */
    private $eventHandler;
    /** @var GitHooksParameters Параметры хуков */
    private $parameters;

    /**
     * GitHook constructor.
     * @param string $hook
     * @param EventInterface $event
     * @param EventHandlerInterface $eventHandler
     * @param GitHooksParameters|object|null $parameters
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function __construct(
        string $hook,
        EventInterface $event,
        EventHandlerInterface $eventHandler,
        GitHooksParameters $parameters = null
    ) {
        $this->hook         = $hook;
        $this->event        = $event;
        $this->eventHandler = $eventHandler;
        $this->parameters   = $parameters ?? GitHooksParameters::make();
        parent::__construct([]);
        $this->validateHookName();
    }

    /**
     * Проверяет праавильность ввода имени хука
     * @throws InvalidConfigException
     */
    private function validateHookName()
    {
        if (!$this->parameters->hookExists($this->hook)) {
            throw new InvalidConfigException('Hook must bee in ' . $this->parameters->getHooks());
        }
    }

    /**
     * @return string
     */
    public function getHook(): string
    {
        return $this->hook;
    }

    /**
     * @param string $hook
     * @return static
     */
    public function setHook(string $hook): self
    {
        $this->hook = $hook;

        return $this;
    }

    /**
     * @return EventInterface
     */
    public function getEvent(): EventInterface
    {
        return $this->event;
    }

    /**
     * @param EventInterface $event
     * @return static
     */
    public function setEvent(EventInterface $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return EventHandlerInterface
     */
    public function getEventHandler(): EventHandlerInterface
    {
        return $this->eventHandler;
    }

    /**
     * @param EventHandlerInterface $eventHandler
     * @return static
     */
    public function setEventHandler(EventHandlerInterface $eventHandler): self
    {
        $this->eventHandler = $eventHandler;

        return $this;
    }

}