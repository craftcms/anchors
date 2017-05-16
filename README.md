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

## Configuration

To configure Anchors, create a new “anchors.php” file within the craft/config folder, which returns an array.

The following config settings are supported:

- **anchorClass** – The class name that should be given to named anchors. (Default is `null`, meaning no class will be given.)
- **anchorLinkClass** – The class name that should be given to anchor links. (Default is `'anchor'`.)
- **anchorLinkText** – The visible text that anchor links should have. (Default is `'#'`'.)
- **anchorLinkTitleText** – The title/alt text that anchor links should have. If `{heading}` is included, it will be replaced with the heading text the link is associated with. (Default is `'Direct link to {heading}'`.)

## Plugin API

Other plugins can take advantage of Anchors using the provided API.

```php
$parsedHtml = craft\anchors\Plugin::getInstance()->anchors->parseHtml($html);
```

Like the `|anchors` templating filter, `parseHtml()` also allows you to specify which HTML tags should get anchors.

```php
$parsedHtml = craft\anchors\Plugin::getInstance()->anchors->parseHtml($html, 'h2,h3');
```

You can also pass some heading text directly into Anchors to get its generated anchor name:

```php
$anchorName = craft\anchors\Plugin::getInstance()->anchors->generateAnchorName($headingText);
```
