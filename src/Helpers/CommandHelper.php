<?php


namespace Flowwow\Githooks\Helpers;


use Flowwow\Githooks\Models\GitHooksParameters;
use Flowwow\Githooks\Traits\MakeTrait;

/**
 * Помошник команд хуков
 * Class CommandHelper
 * @package Flowwow\Githooks\Helpers
 */
class CommandHelper
{
    use MakeTrait;

    /** @var GitHooksParameters Параметры хуков */
    private $parameters;

    /**
     * CommandHelper constructor.
     * @param GitHooksParameters $parameters
     */
    public function __construct(GitHooksParameters $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Команда сборщика пакетов php
     * @param string $arguments
     * @return string|null
     */
    public function composer(string $arguments = 'install'): ?string
    {
        $command = "cd {$this->parameters->getBaseDirectory()} && {$this->parameters->getComposerPath()} {$arguments}";

        return shell_exec($command);
    }

    /**
     * Команда сборщика пакетов node
     * @param string $arguments
     * @return string|null
     */
    public function npm(string $arguments = 'install'): ?string
    {
        $command = "cd {$this->parameters->getBaseDirectory()} && {$this->parameters->getNpmPath()} {$arguments}";

        return shell_exec($command);
    }

    /**
     * Команда упаковкища фронт файлов
     * @param string $arguments
     * @return string|null
     */
    public function gulp(string $arguments = 'build'): ?string
    {
        $command = "cd {$this->parameters->getBaseDirectory()} && {$this->parameters->getGulpPath()} {$arguments}";

        return shell_exec($command);
    }

    /**
     * Консольный вызов yii2
     * @param string |null $arguments
     * @return string|null
     */
    public function yii(string $arguments = null): ?string
    {
        $command = "cd {$this->parameters->getBaseDirectory()} && php {$this->parameters->getYiiPath()} {$arguments}";

        return shell_exec($command);
    }

    /**
     * Консольный вызов миграции
     * @param string $arguments
     * @return string|null
     */
    public function yiiMigrate(string $arguments = 'migrate --interactive=0'): ?string
    {
        return $this->yii($arguments);
    }

    /**
     * Консольный вызов сброса кеша
     * @param string $arguments
     * @return string|null
     */
    public function yiiFlushCache(string $arguments = 'cache/flush-schema --interactive=0'): ?string
    {
        return $this->yii($arguments);
    }

    /**
     * Консольный вызов настроек rbac
     * @param string $arguments
     * @return string|null
     */
    public function yiiRbacInit(string $arguments = 'rbac/init'): ?string
    {
        return $this->yii($arguments);
    }

    /**
     * Консольный вызов настройки redis
     * @param string $arguments
     * @return string|null
     */
    public function yiiConsoleRedis(string $arguments = 'redis/drop'): ?string
    {
        return $this->yii($arguments);
    }

    /**
     * Консольный вызов git
     * @param string $arguments
     * @return string|null
     */
    public function git(string $arguments): ?string
    {
        $command = "cd {$this->parameters->getBaseDirectory()} && {$this->parameters->getGitPath()} {$arguments}";

        return shell_exec($command);
    }

    /**
     * Устанавливает директорию для хуков
     * @param string $directory
     * @return string|null
     */
    public function gitSetHookDirectory(string $directory = '.githooks')
    {
        return $this->git("config core.hooksPath {$directory}");
    }

    /**
     * Получает измененные  файлы git
     * @return array
     */
    public function getGitDiffFiles(): array
    {
        $changedFiles = [];
        $diffs        = $this->git("diff-tree -r --name-only --no-commit-id HEAD@{1} HEAD");
        foreach (explode("\n", (string)$diffs) as $filepath) {
            if (!empty($filepath)) {
                $changedFiles[] = $filepath;
            }
        }

        return $changedFiles;
    }
}