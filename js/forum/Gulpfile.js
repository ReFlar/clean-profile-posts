var gulp = require('flarum-gulp');

gulp({
  modules: {
    'reflar/clean-profile-posts': [
      'src/**/*.js',
    ]
  }
});
