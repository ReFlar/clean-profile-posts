'use strict';

System.register('reflar/clean-profile-posts/main', ['flarum/components/PostsUserPage', 'flarum/extend'], function (_export, _context) {
  "use strict";

  var PostsUserPage, override;
  return {
    setters: [function (_flarumComponentsPostsUserPage) {
      PostsUserPage = _flarumComponentsPostsUserPage.default;
    }, function (_flarumExtend) {
      override = _flarumExtend.override;
    }],
    execute: function () {

      app.initializers.add('reflar/clean-profile-posts', function () {
        override(PostsUserPage.prototype, 'loadResults', function (original) {
          return original().then(function (posts) {
            return posts.filter(function (p) {
              return p.number() > 1;
            });
          });
        });
      });
    }
  };
});