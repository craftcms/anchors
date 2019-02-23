# Anchors for Craft CMS

This plugin makes it possible to automatically add linkable anchors to HTML headings in Craft.

The anchors are named based on the heading text. The algorithm Anchors uses to convert the heading text to IDs is similar to Craft’s algorithm for automatically generating entry slugs.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.27 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Anchors”. Then click on the “Install” button in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require craftcms/anchors

# tell Craft to install the plugin
./craft install/plugin anchors
```

## Templating

To use Anchors in your templates, just pass some HTML into the `|anchors` filter.

```twig
{{ entry.body|anchors }}
```

By default, the `anchors` filter will only search for `<h1>`, `<h2>`, and `<h3>` tags. You can customize which tags it searches for by passing in a comma-separated list of tag names.

```twig
{{ entry.body|anchors('h2,h3') }}
```

The `anchors` filter will convert any non-ASCII characters to ASCII, using the current site’s language’s ASCII character mappings by default.

If you are displaying content in a different language than the current site, use the `language` argument to override which ASCII character mappings should be used:

```twig
{{ entry.body|anchors(language=entry.site.language) }}
```

## Configuration

To configure Anchors, create a new `anchors.php` file within the `config/` folder, which returns an array.

The following config settings are supported:

- `anchorClass` – The class name that should be given to named anchors. (Default is `null`, meaning no class will be given.)
- `anchorLinkClass` – The class name that should be given to anchor links. (Default is `'anchor'`.)
- `anchorLinkText` – The visible text that anchor links should have. (Default is `'#'`'.)
- `anchorLinkTitleText` – The title/alt text that anchor links should have. If `{heading}` is included, it will be replaced with the heading text the link is associated with. (Default is `'Direct link to {heading}'`.)

## Plugin API

Other plugins can take advantage of Anchors using the provided API.

```php
$parsedHtml = \craft\anchors\Plugin::getInstance()->parser->parseHtml($html);
```

Like the `|anchors` templating filter, `parseHtml()` also allows you to specify which HTML tags should get anchors.

```php
$parsedHtml = \craft\anchors\Plugin::getInstance()->parser->parseHtml($html, 'h2,h3');
```

You can also pass some heading text directly into Anchors to get its generated anchor name:

```php
$anchorName = \craft\anchors\Plugin::getInstance()->parser->generateAnchorName($headingText);
```
