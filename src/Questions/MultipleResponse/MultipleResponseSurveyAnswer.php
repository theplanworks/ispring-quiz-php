<?php

namespace ThePLAN\IspringQuizPhp\Questions\MultipleResponse;

use DOMElement;
use ThePLAN\IspringQuizPhp\Utils\XmlUtils;

class MultipleResponseSurveyAnswer
{
    public $selected;

    public $text;

    public $customAnswer = '';

    public function initFromXmlNode(DOMElement $node)
    {
        $this->selected = $node->getAttribute('selected') == 'true';
        $this->text = XmlUtils::getElementText($node);

        if ($node->hasAttribute('customAnswer')) {
            $this->customAnswer = trim($node->getAttribute('customAnswer'));
        }
    }
}
