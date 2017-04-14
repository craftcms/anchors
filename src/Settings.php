<?php

namespace craft\anchors;

use craft\base\Model;

class Settings extends Model
{
    public $anchorClass;
    public $anchorLinkClass = 'anchor';
    public $anchorLinkText = '#';
    public $anchorLinkTitleText = 'Direct link to {heading}';

}