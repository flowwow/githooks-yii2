<?php

namespace githooks\interfaces;

use githooks\models\GitHooksParameters;

/**
 * Описывает событие хука
 * Interface EventInterface
 * @package console\modules\githooks\interfaces
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
     * Получает настройки [erjd
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