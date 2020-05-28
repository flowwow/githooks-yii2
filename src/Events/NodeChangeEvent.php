<?php


namespace Flowwow\Githooks\Events;


/**
 * Событие при обновлении файла package.json
 * Class PackageUpdateEvent
 * @package Flowwow\Githooks\Events
 */
class NodeChangeEvent extends FileChangeEvent
{
    /** @var string Имя файла */
    protected $filename = 'package-lock.json';

}