<?php

namespace ThePLAN\IspringQuizPhp\Questions;

use DOMElement;
use ThePLAN\IspringQuizPhp\Utils\XmlUtils;

class Text
{
    /**
     * @var string
     */
    private $value;

    public function __construct($value = '')
    {
        $this->setValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function initFromXmlNode(DOMElement $node)
    {
        if ($node->hasAttribute('value')) {
            $text = $node->getAttribute('value');
        } else {
            $text = XmlUtils::getElementText($node);
        }

        $this->value = $text ? trim($text) : '';
    }
}
