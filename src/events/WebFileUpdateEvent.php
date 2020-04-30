<?php


namespace Flowwow\Githooks\Events;


/**
 * Событие при обновлении файлов с фронт расширениями
 * Class WebFileUpdateEvent
 * @package Flowwow\Githooks\Events;
 */
class WebFileUpdateEvent extends FileExtensionChangeEvent
{
    protected $extensions = ['css', 'sass', 'less', 'js'];
}