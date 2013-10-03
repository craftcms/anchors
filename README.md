# Anchors plugin for Craft

Adds a new `anchors` filter to Craft, which will search for headings within the passed-in text, and make them linkable by adding `<a>`s to them.

The anchor IDs are dynamically generated based on the heading text. The algorithm Anchors uses to convert the heading text to IDs is similar to Craft’s algorithm for automatically generating entry slugs.

By default, the `anchors` filter will only search for `<h1>`, `<h2>`, and `<h3>` tags. You can customize which tags it searches for by passing in a comma-separated list of tag names:

    {{ entry.body | anchors('h1,h2') }}

## Installation

To install Anchors, copy the anchors/ folder into craft/plugins/, and then go to Settings > Plugins and click the “Install” button next to “Anchors”.
