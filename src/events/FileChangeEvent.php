<?php


namespace githooks\events;


/**
 * Событие при обновлении файла
 * Class FileChangeEvent
 * @package console\modules\githooks\events
 */
class FileChangeEvent extends BaseEvent
{
    /** @var string Имя изменившегося файла */
    protected $filename = '';

    /**
     * @param array $changeFiles
     * @return bool
     */
    public function check(array $changeFiles): bool
    {
        $pattern = str_replace('.', '\.', $this->getFilename());
        foreach ($changeFiles as $filepath) {
            if (preg_match("/$pattern$/u", $filepath)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return static
     */
    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

}