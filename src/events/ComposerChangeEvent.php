<?php


namespace githooks\events;


/**
 * Событие при обновлении файла composer.json
 * Class ComposerUpdateEvent
 * @package console\modules\githooks\events
 */
class ComposerChangeEvent extends FileChangeEvent
{
    /** @var string Имя файла */
    protected $filename = 'composer.json';
}