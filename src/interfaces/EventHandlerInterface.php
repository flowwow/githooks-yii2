<?php

namespace githooks\interfaces;

use githooks\models\GitHooksParameters;

/**
 * Описывает обработчик события
 * Interface HandlerInterface
 * @package console\modules\githooks\interfaces
 */
interface EventHandlerInterface
{
    /**
     * @param array $changeFiles
     * @return string|null
     */
    public function handle(array $changeFiles): ?string;

    /**
     * @return GitHooksParameters
     */
    public function getParameters(): GitHooksParameters;

    /**
     * @param GitHooksParameters $parameters
     * @return static
     */
    public function setParameters(GitHooksParameters $parameters): EventHandlerInterface;

    /**
     * @return string
     */
    public function getArguments(): string;

    /**
     * @param string $arguments
     * @return static
     */
    public function setArguments(string $arguments): EventHandlerInterface;

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @param string $comment
     * @return static
     */
    public function setComment(string $comment): EventHandlerInterface;
}