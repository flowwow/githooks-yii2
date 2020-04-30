<?php


namespace Flowwow\Githooks\Events;


use yii\base\InvalidConfigException;

/**
 * Событие при обновлении файлов с расширениями
 * Class FileExtensionsChangeEvent
 * @package Flowwow\Githooks\Events;
 */
class FileExtensionChangeEvent extends BaseEvent
{
    /** @var array Расширения файла */
    protected $extensions = [];

    /**
     * @param array $changeFiles
     * @return bool
     */
    public function check(array $changeFiles): bool
    {
        $pattern = '(' . implode('|', $this->getExtensions()) . ')';
        $pattern = str_replace('.', '\.', $pattern);
        foreach ($changeFiles as $filepath) {
            if (preg_match("/$pattern/u", $filepath)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * @param array $extensions
     * @return static
     * @throws InvalidConfigException
     */
    public function setExtensions(array $extensions): self
    {
        foreach ($extensions as $extension) {
            if (!is_string($extension)) {
                throw new InvalidConfigException('Extension must be string');
            }
        }
        $this->extensions = $extensions;

        return $this;
    }

}