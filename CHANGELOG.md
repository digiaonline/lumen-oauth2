# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

NOTE: Always keep an Unreleased version at the top of this CHANGELOG for easy updating.
Don't forget to update the links at the bottom of the CHANGELOG.

## [Unreleased] - YYYY-MM-DD
### Added
- For new features.

### Changed
- For changes in existing functionality.

### Deprecated
- For once-stable features removed in upcoming releases.

### Removed
- For deprecated features removed in this release.

### Fixed
- For any bug fixes.

### Security
- To invite users to upgrade in case of vulnerabilities.

## [3.1.1] - 2017-06-05
### Added
- Validate access token to OAuth2Service function calls.
- ODM module to suggestions.

### Fixed
- Tests.

## [3.1.0] - 2017-06-02
### Added
- Support for Authorization Code grant type.

## [3.0.0] - 2017-02-10
### Changed
- Update lumen framework version to 5.4.
- Update tests.

## [2.0.0] - 2016-11-19
### Added
- Unit tests.
- Badges.

### Changed
- Minimum PHP requirement.
- Move Eloquent storage connector to own repository.

### Removed
- Eloquent storage connector.

## [1.4.0] - 2016-03-22
### Changed
- Fix namespaces.

## [1.3.1] - 2016-03-07
### Changed
- Update lumen-core to 1.0.

## [1.3.0] - 2016-03-07
### Added
- YAML mapping to doctrine implementation
- Badges.

### Changed
- Move OAuth2Middleware and OAuthFacade to source root.
- Re-factor OAuth2ServiceProvider.

## [1.2.1] - 2016-02-22
### Fixed
- Add check for class exists when registering facades.

## [1.2.0] - 2016-02-18
### Added
- AuthenticatesUsers trait.

### Changed
- OAuth2Middleware to use traits.

## [1.1.5] - 2016-02-18
### Changed
- Improvements to Eloquent.

## [1.1.4] - 2015-11-13
### Fixed
- Doctrine mapping for client.

## [1.1.3] - 2015-08-24
### Changed
- Exception types.

## [1.1.2] - 2015-07-09
### Changed
- Same as 1.1.1.

## [1.1.1] - 2015-07-09
### Changed
- Rename class to match file name.

## [1.1.0] - 2015-07-09
### Changed
- Rename Doctrine and Eloquent service providers

### Fixed
- Bug that caused refresh token to be removed when access token expires.

## [1.0.0] - 2015-06-18
### Added
- Project files.
- Support for eloquent.

[Unreleased]: https://github.com/nordsoftware/lumen-oauth2/compare/3.1.1...HEAD
[3.1.1]: https://github.com/nordsoftware/lumen-oauth2/compare/3.1.0...3.1.1
[3.1.0]: https://github.com/nordsoftware/lumen-oauth2/compare/3.0.0...3.1.0
[3.0.0]: https://github.com/nordsoftware/lumen-oauth2/compare/2.0.0...3.0.0
[2.0.0]: https://github.com/nordsoftware/lumen-oauth2/compare/1.4.0...2.0.0
[1.4.0]: https://github.com/nordsoftware/lumen-oauth2/compare/1.3.1...1.4.0
[1.3.1]: https://github.com/nordsoftware/lumen-oauth2/compare/1.3.0...1.3.1
[1.3.0]: https://github.com/nordsoftware/lumen-oauth2/compare/1.2.1...1.3.0
[1.2.1]: https://github.com/nordsoftware/lumen-oauth2/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.5...1.2.0
[1.1.5]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.4...1.1.5
[1.1.4]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.3...1.1.4
[1.1.3]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.2...1.1.3
[1.1.2]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/nordsoftware/lumen-oauth2/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/nordsoftware/lumen-oauth2/compare/1.0.0...1.1.0
[1.0.0]: https://github.com/nordsoftware/lumen-oauth2/tree/1.0.0
