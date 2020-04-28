<?php


namespace githooks\eventHandlers;

use githooks\helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Выполняет обновление файлов ролей
 * Class RbacUpdateEventHandler
 * @package console\modules\githooks\eventHandlers
 */
class RbacUpdateEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'rbac/init';
    /** @var string Коментарий обработчика */
    protected $comment = '* Обновим правила ролей ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make();

        return $command->yii($this->getArguments());
    }
}