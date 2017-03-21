# Anchors plugin for Craft CMS v3

This plugin makes it possible to automatically add linkable anchors to HTML headings in Craft.

The anchors are named based on the heading text. The algorithm Anchors uses to convert the heading text to IDs is similar to Craft’s algorithm for automatically generating entry slugs.

## Installation

To install Anchors, follow these steps:

1. Download & unzip the file and place the `anchors` directory into your `craft/plugins` directory
	- -OR- do a `git clone https://github.com/mikestreety/anchors.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
	- -OR- install with Composer via `composer require mikestreety/anchors`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `anchors` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

## Templating

To use Anchors in your templates, just pass some HTML into the `|anchors` filter.

```jinja
{{ entry.body|anchors }}
```

By default, the `anchors` filter will only search for `<h1>`, `<h2>`, and `<h3>` tags. You can customize which tags it searches for by passing in a comma-separated list of tag names.

```jinja
{{ entry.body|anchors('h2,h3') }}
```

## Configuration

To configure Anchors, create a new “anchors.php” file within the craft/config folder, which returns an array.

The following config settings are supported:

- **anchorClass** – The class name that should be given to named anchors. (Default is `null`, meaning no class will be given.)
- **anchorLinkClass** – The class name that should be given to anchor links. (Default is `'anchor'`.)
- **anchorLinkText** – The visible text that anchor links should have. (Default is `'#'`'.)
- **anchorLinkTitleText** – The title/alt text that anchor links should have. If `{heading}` is included, it will be replaced with the heading text the link is associated with. (Default is `'Direct link to {heading}'`.)

## Changelog

### 1.3.1

* Fixed a bug where non-breaking spaces within headings could result in named anchors with “nbsp” in the name.

### 1.3

* Added ‘anchorClass’, ‘anchorLinkClass’, ‘anchorLinkText’, and ‘anchorLinkTitleText’ config settings.
* The plugin now creates separate named anchor elements that are placed before the headings, rather than adding an `id` attribute to the headings.

### 1.2

* Updated to take advantage of new Craft 2.5 plugin features.

### 1.1

* Added AnchorsService, available globally from `craft()->anchors`, with two public methods:
  * `parseHtml()`
  * `generateAnchorName()`

### 1.0

* Initial release