<?php


namespace Flowwow\Githooks\Events;


/**
 * Событие при обновлении файла composer.json
 * Class ComposerUpdateEvent
 * @package Flowwow\Githooks\Events;
 */
class ComposerChangeEvent extends FileChangeEvent
{
    /** @var string Имя файла */
    protected $filename = 'composer.json';
}