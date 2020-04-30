# githooks
Git hooks handlers for yii2

The git versioning system provides many project management features including an event-based model.
The git event model provides the ability to call scripts after events have occurred, such as switching to another branch, loading a project on a local branch, and others.
This package provides the ability to register git events and make settings depending on the event that occurred.

To install the composer package,
* add repository: ` {
            "type": "vcs",
            "url": "https://github.com/shesternin0/flowwow-githooks.git"
        }`
* run the command: `composer require flowwow/githooks`

1) Next, you need to connect the console module to the configuration @console\config\main.php

```
    'modules' => [
        'githooks' => githooks\Module:: class
    ]
```

2) the Plug-in will add 2 commands to the console:

* githooks/hooks/register Registers event settings
* githooks/hooks/handle capturing the event

3) next, you should unsubscribe the configuration for events. Configuration is performed using the yii2 dependency inversion container.
The entire configuration is unsubscribed in the project container section:

```
    'container' => [
        'singletons' => [
            ....
        ]
    ]
```

4) The following models participate in the configuration:

* GitHookRule - Hook rule
* BaseEvent implements EventInterface is a Base class events
* BaseEventHandler implements EventHandlerInterface-Base class of event handlers

5) by default, hook settings have preset values. You can override them and specify a link to the settings


```
    'githook.yii.parameters' => function () {
        return GitHooksParameters::make();
    },
```


6) Next, you need to configure the rules:
Each rule contains:
* Name of the git hook
* Event model
* Handler model
* An optional set of parameters GitHookParameters
```
    'githook.post_merge.migrate' => function () {
        return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
    MigrateEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
    },
    'githook.post_merge.cache_flush' => function () {
        return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
    CacheFlushEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
    },
```

6) After the configuration of git events is described, you need to register the hook with the githooks/hooks/register console command
This command will create the {ROOT}./.githooks / folder and upload files for git hooks to it

The following events are available in the basic configuration:

* AlwaysEvent-Always returns true
* ComposerChangeEvent   - whether the composer.json file has Changed
* NodeChangeEvent       - whether the package file has Changed.json
* WebFileUpdateEvent    - whether the css,js,sass,less files have Changed

as well as event handlers:

* ComposerUpdateEventHandler    - handler for the composer install command
* CacheFlushEventHandler        - handler for the yii cache/flush-all command
* GulpUpdateEventHandler        - handler for the gulp build command
* MigrateEventHandler           - handler for the yii migrate command
* NodeUpdateEventHandler        - handler for the npm install command
* RbacUpdateEventHandler        - handler for the yii rbac/init command
* RedisDropEventHandler         - handler for the yii redis/drop command

You can create your own events
inheriting the BaseEvent class or applying the EventInterface interface
Handlers inherit the BaseEventHandler class or the EventHandlerInterface interface

7) Next, add the rules to the hook parameters.
```
    GitHooksParameters :: class => [
        'rules' => [
            Instance :: of ('githook.post_merge.migrate'),
            Instance :: of ('githook.post_merge.cache_flush'),
        ]
    ]
```
That's all.


Here is an example of a full config
```
        'githook.yii.parameters'              => function () {
            return GitHooksParameters::make();
        },
        'githook.yii_test.parameters'         => function () {
            $parameters = GitHooksParameters::make();
        
            return $parameters->setYiiPath('yii_test');
        },
        'githook.post_merge.migrate'          => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
                MigrateEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
        },
        'githook.post_merge.cache_flush'      => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
                CacheFlushEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
        },
        'githook.post_merge.lang_drop'        => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
                RedisDropEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
        },
        'githook.post_merge.composer_install' => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, ComposerChangeEvent::make(),
                ComposerUpdateEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
        },
        'githook.post_merge.npm_install'      => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, NodeChangeEvent::make(),
                NodeUpdateEventHandler::make(), Yii::$container->get('githook.yii.parameters'));
        },
        'githook.post_merge.test_migrate'     => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
                MigrateEventHandler::make(), Yii::$container->get('githook.yii_test.parameters'));
        },
        'githook.post_merge.test_cache_flush' => function () {
            return new GitHookRule(GitHooksParameters::HOOK_POST_MERGE, AlwaysEvent::make(),
                CacheFlushEventHandler::make(), Yii::$container->get('githook.yii_test.parameters'));
        },
        GitHooksParameters::class             => [
            'rules' => [
                Instance::of('githook.post_merge.migrate'),
                Instance::of('githook.post_merge.cache_flush'),
                Instance::of('githook.post_merge.lang_drop'),
                Instance::of('githook.post_merge.composer_install'),
                Instance::of('githook.post_merge.npm_install'),
                Instance::of('githook.post_merge.test_migrate'),
                Instance::of('githook.post_merge.test_cache_flush'),
            ]
        ]
```