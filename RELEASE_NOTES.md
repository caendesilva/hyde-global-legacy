## [Unreleased] - YYYY-MM-DD

### About

Keep an Unreleased section at the top to track upcoming changes.

This serves two purposes:

1. People can see what changes they might expect in upcoming releases
2. At release time, you can move the Unreleased section changes into a new release version section.

### Added
- Added a pseudo-router module which will internally be used to improve Hyde auto-discovery
- Added a Route facade that allows you to quickly get a route instance from a route key or path

### Changed
- internal refactor: Creates a new build service to handle the build process

### Deprecated
- Deprecated `DiscoveryService::findModelFromFilePath()` - Use the Router instead.

### Removed
- The "no pages found, skipping" message has been removed as the build loop no longer recieves empty collections.

### Fixed
- for any bug fixes.

### Security
- in case of vulnerabilities.