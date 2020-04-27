<?php


namespace githooks\events;


/**
 * Событие всегда возвращающее true
 * Class AlwaysEvent
 * @package console\modules\githooks\events
 */
class AlwaysEvent extends BaseEvent
{
    public function check(array $changeFiles): bool
    {
        return true;
    }
}