<?php


namespace Flowwow\Githooks\Models;


use Flowwow\Githooks\Helpers\CommandHelper;
use Flowwow\Githooks\Traits\MakeTrait;
use yii\base\InvalidConfigException;

/**
 * Описыват логику регистрации хуков
 * Class RegisteredComponent
 * @package Flowwow\Githooks\Models
 */
class RegisteredComponent
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
     * Обновляет файлы хуков
     * @throws InvalidConfigException
     */
    public function updateHookFiles()
    {
        $this->deleteOldHookFiles();
        $this->createBootstrapFile();
        $this->createHookFiles();
        $this->setHookDirectory();
    }

    /**
     * Получает уникальные имена файлов из регистрации
     * @return array
     */
    private function getActiveHookNames(): array
    {
        return array_unique(array_column($this->rules, 'hook'));
    }

    /**
     * Удаляет все файлы в директории хука
     * @throws InvalidConfigException
     */
    private function deleteOldHookFiles()
    {
        $hookDirectory = $this->parameters->getHookDirectory();
        foreach (scandir($hookDirectory) as $file) {
            if ($file == '.' || $file = '..') {
                continue;
            }
            unlink($file);
        }
    }

    /**
     * Создает файл загрузчика
     * @throws InvalidConfigException
     */
    private function createBootstrapFile()
    {
        $component = BootstrapFileComponent::make();
        $component->update();
    }

    /**
     * Создает обработчики хуков
     * @throws InvalidConfigException
     */
    private function createHookFiles()
    {
        $this->getActiveHookNames();
        $component = HookFileComponent::make();
        $component->update($this->getActiveHookNames());
    }

    /**
     * Устанавливает директорию для хуков
     * @return string|null
     * @throws InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    private function setHookDirectory()
    {
        return CommandHelper::make()->gitSetHookDirectory();
    }
}