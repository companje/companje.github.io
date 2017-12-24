---
title: jekyll
---

# 
[You can configure a third-party service such as Travis CI to display error messages after each commit.](https://help.github.com/articles/viewing-jekyll-build-error-messages/#configuring-a-third-party-service-to-display-jekyll-build-error-messages
)

# bundle install
```bash
bundle install
```

# Liquid Exception: no implicit conversion of Fixnum into String.
caused by 'escape' liquid tag in `_layouts/x.html`.

# get version
```bash
bundle exec jekyll -v
```

# serve locally
```bash
bundle exec jekyll serve --profile --incremental --verbose
```


# defaults
add this to _config.xml to give a the default page template
```yaml
defaults:
  -
    scope:
      path: "" # an empty string here means all files in the project
    values:
      layout: "default"
```