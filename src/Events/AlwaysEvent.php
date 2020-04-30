<?php


namespace Flowwow\Githooks\Events;


/**
 * Событие всегда возвращающее true
 * Class AlwaysEvent
 * @package Flowwow\Githooks\Events
 */
class AlwaysEvent extends BaseEvent
{
    public function check(array $changeFiles): bool
    {
        return true;
    }
}