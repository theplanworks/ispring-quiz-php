<?php

namespace ThePLAN\IspringQuizPhp\Questions\Essay;

use DOMElement;
use ThePLAN\IspringQuizPhp\Questions\Question;

class EssayQuestion extends Question
{
    public function isGradedByDefault()
    {
        return false;
    }

    public function initFromXmlNode(DOMElement $node)
    {
        parent::initFromXmlNode($node);

        $userAnswerNodeList = $node->getElementsByTagName('userAnswer');
        if ($userAnswerNodeList->length > 0) {
            $userAnswer = trim($userAnswerNodeList->item(0)->textContent);
            $this->userAnswer = str_replace("\n", PHP_EOL, $userAnswer);
        }
    }
}
