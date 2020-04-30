<?php


namespace Flowwow\Githooks\Models;


use Flowwow\Githooks\Traits\MakeTrait;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;

/**
 * Настройки пакета githooks
 * Class GitHooksParameters
 * @package Flowwow\Githooks\Models
 */
class GitHooksParameters extends BaseObject
{
    use MakeTrait;

    /** @var string События после мерджа */
    const HOOK_POST_MERGE = 'post-merge';
    /** @var string Событие после перехода на ветку */
    const HOOK_POST_CHECKOUT = 'post-checkout';
    /** @var string Событие после перезаписи */
    const HOOK_POST_REWRITE = 'post-rewrite';
    /** @var string Событие после коммита */
    const HOOK_POST_COMMIT = 'post-commit';

    /** @var Instance[] Массив правил */
    private $rules;
    /** @var array Список доступных хуков */
    private $hooks = [
        self::HOOK_POST_CHECKOUT,
        self::HOOK_POST_COMMIT,
        self::HOOK_POST_MERGE,
        self::HOOK_POST_REWRITE,
    ];
    /** @var string Директория хуков */
    private $hookDirectory;
    /** @var string Директория для шаблонов */
    private $templatesDirectory;
    /** @var string Базовая директория проекта */
    private $baseDirectory;
    /** @var string Путь до git */
    private $gitPath = 'git';
    /** @var string Путь до компосера */
    private $composerPath = 'composer';
    /** @var string Путь до npm */
    private $npmPath = 'npm';
    /** @var string Путь до gulp */
    private $gulpPath = 'gulp';
    /** @var string Путь до консольного скрипта yii */
    private $yiiPath = 'yii';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->setBaseDirectory(dirname(Yii::getAlias('@console')));
        $this->setHookDirectory("{$this->baseDirectory}/.githooks/");
        $this->setTemplatesDirectory(dirname(__DIR__) . '/templates/');
    }

    /**
     * Существует ли хук
     * @param string $hookName
     * @return bool
     */
    public function hookExists(string $hookName): bool
    {
        return in_array($hookName, $this->hooks);
    }

    /**
     * Получает список правил
     * @return Instance[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     * @return static
     */
    public function setRules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @return array
     */
    public function getHooks(): array
    {
        return $this->hooks;
    }

    /**
     * @param array $hooks
     * @return static
     */
    public function setHooks(array $hooks): self
    {
        $this->hooks = $hooks;

        return $this;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getHookDirectory(): string
    {
        if (!file_exists($this->hookDirectory)) {
            if (!mkdir($this->hookDirectory)) {
                throw new InvalidConfigException("Unable to create hook directory in {$this->hookDirectory}");
            }
        }

        return $this->hookDirectory;
    }

    /**
     * @param string $hookDirectory
     * @return static
     * @throws InvalidConfigException
     */
    public function setHookDirectory(string $hookDirectory): self
    {
        if (!file_exists($hookDirectory)) {
            if (!mkdir($hookDirectory)) {
                throw new InvalidConfigException("Unable to create hook directory in {$hookDirectory}");
            }
        }
        $this->hookDirectory = $hookDirectory;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplatesDirectory(): string
    {
        return $this->templatesDirectory;
    }

    /**
     * @param string $templatesDirectory
     * @return static
     * @throws InvalidConfigException
     */
    public function setTemplatesDirectory(string $templatesDirectory): self
    {
        if (!file_exists($templatesDirectory)) {
            throw new InvalidConfigException("Directory {$templatesDirectory} not found");
        }
        $this->templatesDirectory = $templatesDirectory;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseDirectory(): string
    {
        return $this->baseDirectory;
    }

    /**
     * @param string $baseDirectory
     * @return static
     * @throws InvalidConfigException
     */
    public function setBaseDirectory(string $baseDirectory): self
    {
        if (!file_exists($baseDirectory)) {
            throw new InvalidConfigException("Directory {$baseDirectory} not found");
        }
        $this->baseDirectory = $baseDirectory;

        return $this;
    }

    /**
     * @return string
     */
    public function getComposerPath(): string
    {
        return $this->composerPath;
    }

    /**
     * @param string $composerPath
     * @return static
     */
    public function setComposerPath(string $composerPath): self
    {
        $this->composerPath = $composerPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getNpmPath(): string
    {
        return $this->npmPath;
    }

    /**
     * @param string $npmPath
     * @return static
     */
    public function setNpmPath(string $npmPath): self
    {
        $this->npmPath = $npmPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getGulpPath(): string
    {
        return $this->gulpPath;
    }

    /**
     * @param string $gulpPath
     * @return static
     */
    public function setGulpPath(string $gulpPath): self
    {
        $this->gulpPath = $gulpPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getGitPath(): string
    {
        return $this->gitPath;
    }

    /**
     * @param string $gitPath
     * @return static
     */
    public function setGitPath(string $gitPath): self
    {
        $this->gitPath = $gitPath;

        return $this;
    }

    /**
     * @return string
     */
    public function getYiiPath(): string
    {
        return $this->yiiPath;
    }

    /**
     * @param string $yiiPath
     * @return static
     */
    public function setYiiPath(string $yiiPath): self
    {
        $this->yiiPath = $yiiPath;

        return $this;
    }

}