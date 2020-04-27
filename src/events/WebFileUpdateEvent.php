<?php


namespace githooks\events;


/**
 * Событие при обновлении файлов с фронт расширениями
 * Class WebFileUpdateEvent
 * @package console\modules\githooks\events
 */
class WebFileUpdateEvent extends FileExtensionChangeEvent
{
    protected $extensions = ['css', 'sass', 'less', 'js'];
}