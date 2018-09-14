<?php

/**
 *  This file is part of reflar/clean-profile-posts.
 *
 *  Copyright (c) 2018 .
 *
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

namespace Reflar\CleanProfilePosts\Listeners;

use Flarum\Api\Serializer\UserBasicSerializer;
use Flarum\Core\Post;
use Flarum\Core\User;
use Flarum\Event\ConfigurePostsQuery;
use Flarum\Event\PrepareApiAttributes;
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
        $events->listen(PrepareApiAttributes::class, [$this, 'prepareApiAttributes']);
    }

    /**
     * @param ConfigurePostsQuery $event
     */
    public function configurePostsQuery(ConfigurePostsQuery $event)
    {
        $event->query->where('number', '!=', 1);
    }

    public function prepareApiAttributes(PrepareApiAttributes $event) {
        if ($event->isSerializer(UserBasicSerializer::class)) {
            $event->attributes['commentsCount'] = $event->model->posts()->where('number', '!=', 1)->count();
        }
    }

}
