<?php


namespace Flowwow\Githooks\Models;


use Flowwow\Githooks\Helpers\CommandHelper;
use Flowwow\Githooks\Traits\MakeTrait;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Описыват логику обработчиков хуков
 * Class RegisteredComponent
 * @package Flowwow\Githooks\Models;
 */
class HandleComponent
{
    use MakeTrait;

    /** @var GitHooksParameters Параметры хуков */
    private $parameters;
    /** @var GitHookRule[] Правила событий хуков */
    private $rules;

    /**
     * RegisteredComponent constructor.
     * @param GitHooksParameters $parameters
     * @throws InvalidConfigException
     */
    public function __construct(GitHooksParameters $parameters)
    {
        $this->parameters = $parameters;
        $this->rules      = $this->getRules();
    }

    /**
     * Получает правила
     * @return GitHookRule[]
     * @throws InvalidConfigException
     */
    private function getRules(): array
    {
        $rules = [];
        foreach ($this->parameters->getRules() as $rule) {
            $model = $rule->get();
            if (!$model instanceof GitHookRule) {
                throw new InvalidConfigException('Rule must bee instance of GitHookRule');
            }
            $rules[] = $model;
        }

        return $rules;
    }

    /**
     * Обрабатывает событие
     * @param string $hook
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function process(string $hook)
    {
        $activeRules = $this->getActiveRules($hook);
        $changeFiles = CommandHelper::make()->getGitDiffFiles();

        foreach ($activeRules as $rule) {
            if (!$rule->getEvent()->check($changeFiles)) {
                continue;
            }
            $handler = $rule->getEventHandler();
            if (!empty($handler->getComment())) {
                echo "{$handler->getComment()}\n";
            }
            $response = $handler->handle($changeFiles);
            echo "{$response}\n";
        }
    }

    /**
     * Получает уникальные имена файлов из регистрации
     * @return GitHookRule[]
     */
    private function getActiveRules(string $hook): array
    {
        $activeRules = [];
        foreach ($this->rules as $rule) {
            if ($rule->getHook() === $hook) {
                $activeRules[] = $rule;
            }
        }

        return $activeRules;
    }

}