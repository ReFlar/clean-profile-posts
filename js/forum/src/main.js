import PostsUserPage from 'flarum/components/PostsUserPage';
import { override } from 'flarum/extend';

app.initializers.add('reflar/clean-profile-posts', () => {
  override(PostsUserPage.prototype, 'loadResults', (original) =>
      original().then(posts => posts.filter(p => p.number() > 1))
  );
});
