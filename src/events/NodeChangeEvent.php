<?php


namespace githooks\events;


/**
 * Событие при обновлении файла package.json
 * Class PackageUpdateEvent
 * @package console\modules\githooks\events
 */
class NodeChangeEvent extends FileChangeEvent
{
    /** @var string Имя файла */
    protected $filename = 'package.json';

}