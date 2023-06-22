<?php

namespace ThePLAN\IspringQuizPhp\Questions\Sequence;

use DOMElement;
use ThePLAN\IspringQuizPhp\Utils\XmlUtils;

class SequenceSurveyAnswer
{
    public $text;

    public $index;
    public $userDefinedPosition;
    public $originalIndex;

    public function initFromXmlNode(DOMElement $node)
    {
        $this->text = XmlUtils::getElementText($node);
    }
}
