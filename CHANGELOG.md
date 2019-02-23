# Release Notes for Anchors

## 2.2.0 - 2019-02-23

### Changed
- The `|anchors` filter now converts non-ASCII characters to ASCII when generating anchor names. ([#9](https://github.com/craftcms/anchors/issues/9))
- The `|anchors` filter now has a `language` argument, which can be set to specify which language the ASCII character mappings should be pulled from. (The current site language is used by default.)

## 2.1.1 - 2019-02-04

### Changed
- The `|anchors` filter is now available to templates rendered on console requests. ([#8](https://github.com/craftcms/anchors/issues/8))

## 2.1.0 - 2018-07-16

### Changed
- Anchors now use the `id` attribute instead of `name`. ([#4](https://github.com/craftcms/anchors/issues/4))

## 2.0.3 - 2017-12-04

### Changed
- Loosened the Craft CMS version requirement to allow any 3.x version.

## 2.0.2 - 2017-09-28

### Changed
- The plugin no longer forces Twig to be loaded on requests where it wasn’t needed.

### Fixed
- Fixed a bug where HTML tags within headings were not getting stripped for the anchor link `title` text. ([#5](https://github.com/craftcms/anchors/issues/5))

## 2.0.1 - 2017-09-15

### Added
- Craft 3 Beta 27 compatibility.

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
