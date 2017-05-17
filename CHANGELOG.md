Changelog
=========

## 2.0.0 - 2017-05-17

### Added
- Added support for Craft 3.

## 1.3.1 - 2016-07-03

### Fixed
- Fixed a bug where non-breaking spaces within headings could result in named anchors with “nbsp” in the name.

## 1.3.0 - 2016-07-03

### Added
- Added `anchorClass`, `anchorLinkClass`, `anchorLinkText`, and `anchorLinkTitleText` config settings.
- The plugin now creates separate named anchor elements that are placed before the headings, rather than adding an id attribute to the headings.

## 1.2.0 - 2015-12-20

### Changed
- Updated to take advantage of new Craft 2.5 plugin features.

## 1.1.0 - 2014-11-28

### Added
- Added AnchorsService, available globally from craft()->anchors, with two public methods, `parseHtml()` and  `generateAnchorName()`.

## 1.0.0 - 2013-09-23

Initial release.
