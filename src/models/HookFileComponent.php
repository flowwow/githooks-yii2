<?php


namespace githooks\models;


use githooks\traits\MakeTrait;
use yii\base\InvalidConfigException;

/**
 * Обрабатывает логику файлов хуков
 * Class HookFileComponent
 * @package console\modules\githooks\models
 */
class HookFileComponent
{
    use MakeTrait;

    /** @var string Имя шаблона для замены в шаблоне */
    const FILE_HANDLE_NAME_PATTERN = '{handleName}';
    /** @var int Разрешения нового файла */
    const NEW_FILE_PERMISSION = 0755;

    /** @var GitHooksParameters */
    private $parameters;
    /** @var string Путь файла шаблона */
    private $templateFilepath;

    /**
     * HookFileComponent constructor.
     * @param GitHooksParameters $parameters
     */
    public function __construct(GitHooksParameters $parameters)
    {
        $this->parameters       = $parameters;
        $this->templateFilepath = "{$this->parameters->getTemplatesDirectory()}/template";
    }

    /**
     * Обновляет файлы хука
     * @param array $fileNames
     * @throws InvalidConfigException
     */
    public function update(array $fileNames)
    {
        $hookTemplate = file_get_contents($this->templateFilepath);
        foreach ($fileNames as $filename) {
            $hook     = str_replace(self::FILE_HANDLE_NAME_PATTERN, $filename, $hookTemplate);
            $hookPath = "{$this->parameters->getHookDirectory()}/{$filename}";
            if (!file_put_contents($hookPath, $hook)) {
                throw new InvalidConfigException("Unable to save githook file {$filename} into {$hookPath}");
            }
            if (!chmod($hookPath, self::NEW_FILE_PERMISSION)) {
                throw new InvalidConfigException("Unable to set permission file {$filename}");
            }
        }
    }
}