<?php

/**
 *  This file is part of reflar/clean-profile-posts.
 *
 *  Copyright (c) 2018 ReFlar
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

namespace Reflar\CleanProfilePosts\Listeners;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Event\ConfigurePostsQuery;
use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyPostsQuery
{

    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigurePostsQuery::class, [$this, 'configurePostsQuery']);
        $events->listen(BasicUserSerializer::class, [$this, 'BasicUserSerializer']);
    }

    /**
     * @param ConfigurePostsQuery $event
     */
    public function configurePostsQuery(ConfigurePostsQuery $event)
    {
        $event->query->where('number', '!=', 1);
    }

    public function prepareApiAttributes(Serializing $event)
    {
        if ($event->isSerializer(BasicUserSerializer::class)) {
            $event->attributes['commentsCount'] = $event->model->posts()
                ->where('number', '!=', 1)
                ->where('hide_time', null)
                ->where('type', 'comment')
                ->count();
        }
    }

}
