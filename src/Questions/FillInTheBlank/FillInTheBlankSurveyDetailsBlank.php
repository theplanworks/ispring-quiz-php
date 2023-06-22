<?php

namespace ThePLAN\IspringQuizPhp\Questions\FillInTheBlank;

use DOMElement;
use ThePLAN\IspringQuizPhp\Questions\AnswersCollection;

class FillInTheBlankSurveyDetailsBlank extends AnswersCollection
{
    public $userAnswer;

    public function initFromXmlNode(DOMElement $node)
    {
        parent::initFromXmlNode($node);

        $this->userAnswer = trim($node->getAttribute('userAnswer'));
    }
}
