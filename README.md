# Anchors plugin for Craft

This plugin makes it possible to automatically add linkable anchors to HTML headings in Craft.

The anchors are named based on the heading text. The algorithm Anchors uses to convert the heading text to IDs is similar to Craft’s algorithm for automatically generating entry slugs.

## Installation

To install Anchors, copy the anchors/ folder into craft/plugins/, and then go to Settings > Plugins and click the “Install” button next to “Anchors”.

## Templating

To use Anchors in your templates, just pass some HTML into the `|anchors` filter.

```jinja
{{ entry.body|anchors }}
```

By default, the `anchors` filter will only search for `<h1>`, `<h2>`, and `<h3>` tags. You can customize which tags it searches for by passing in a comma-separated list of tag names.

```jinja
{{ entry.body|anchors('h2,h3') }}
```

## Plugin API

Other plugins can take advantage of Anchors using the provided API.

```php
$parsedHtml = craft()->anchors->parseHtml($html);
```

Like the `|anchors` templating filter, `parseHtml()` also allows you to specify which HTML tags should get anchors.

```php
$parsedHtml = craft()->anchors->parseHtml($html, 'h2,h3');
```

You can also pass some heading text directly into Anchors to get its generated anchor name:

```php
$anchorName = craft()->anchors->generateAnchorName($headingText);
```

## Changelog

### 1.1

* Added AnchorsService, available globally from `craft()->anchors`, with two public methods:
  * `parseHtml()`
  * `generateAnchorName()`

### 1.0

* Initial release