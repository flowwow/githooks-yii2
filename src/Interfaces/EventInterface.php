<?php

namespace Flowwow\Githooks\Interfaces;

use Flowwow\Githooks\models\GitHooksParameters;

/**
 * Описывает событие хука
 * Interface EventInterface
 * @package Flowwow\Githooks\Interfaces
 */
interface EventInterface
{
    /**
     * Проводит проверку собвтия
     * @param array $changeFiles
     * @return bool
     */
    public function check(array $changeFiles): bool;

    /**
     * Получает настройки хуков
     * @return GitHooksParameters
     */
    public function getParameters(): GitHooksParameters;

    /**
     * Устанавливает настройки хуков
     * @param GitHooksParameters $parameters
     * @return EventInterface
     */
    public function setParameters(GitHooksParameters $parameters): EventInterface;
}