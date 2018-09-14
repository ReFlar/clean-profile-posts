<?php

/**
 *  This file is part of reflar/clean-profile-posts.
 *
 *  Copyright (c) 2018 ReFlar
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

namespace Reflar\CleanProfilePosts;

use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listeners\ModifyPostsQuery::class);
};
