# Release Checklist

* [ ] Get develop branch to the appropriate code release state. Travis CI (if enabled) should pass for all merges to develop.
* [ ] Create a PR from develop to master. Travis CI (if enabled) should pass.
* [ ] Tag the last commit with the version number:
```bash
git checkout master
git tag -a 1.5.0 -m "1.5.0"
```
* [ ] Push: `git push`
* [ ] Push tags: `git push --tags`
* [ ] Update develop branch from master:
```bash
git checkout develop
git merge master --ff-only
git push
```
