<?php


namespace githooks\models;

use githooks\traits\MakeTrait;
use yii\base\InvalidConfigException;

/**
 * Обслуживает файл загрузки
 * Class BootstrapComponent
 * @package console\modules\githooks\models
 */
class BootstrapFileComponent
{
    use MakeTrait;

    /** @var string Шаблон дебага в файле загрузки */
    const YII_DEBUG_PATTERN = '{YII_DEBUG}';
    /** @var string Шаблон окружения в файле загрузки */
    const YII_ENV_PATTERN = '{YII_ENV}';
    /** @var GitHooksParameters */
    private $parameters;
    /** @var string Путь файла шаблона */
    private $templateFilepath;
    /** @var string Путь файла назначения */
    private $destinationFilepath;

    /**
     * BootstrapComponent constructor.
     * @param GitHooksParameters $parameters
     * @throws InvalidConfigException
     */
    public function __construct(GitHooksParameters $parameters)
    {
        $this->parameters          = $parameters;
        $this->templateFilepath    = "{$this->parameters->getTemplatesDirectory()}/bootstrap";
        $this->destinationFilepath = "{$this->parameters->getHookDirectory()}/bootstrap.php";
    }

    /**
     * Обновляет файл загрузки
     * @throws InvalidConfigException
     */
    public function update()
    {
        $bootstrap = file_get_contents($this->templateFilepath);
        $bootstrap = $this->setEnvironment($bootstrap);
        if (!file_put_contents($this->destinationFilepath, $bootstrap)) {
            throw new InvalidConfigException("Unable to save githook bootstrap file into {$this->destinationFilepath}");
        }
    }

    /**
     * Устанавливает окружение
     * @param string $bootstrap
     * @return string
     */
    private function setEnvironment(string $bootstrap): string
    {
        $bootstrap = str_replace(self::YII_DEBUG_PATTERN, YII_DEBUG ? 'true' : 'false', $bootstrap);

        return str_replace(self::YII_ENV_PATTERN, "'" . YII_ENV . "'", $bootstrap);
    }
}