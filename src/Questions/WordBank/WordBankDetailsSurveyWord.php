<?php

namespace ThePLAN\IspringQuizPhp\Questions\WordBank;

use DOMElement;
use ThePLAN\IspringQuizPhp\Questions\Text;

class WordBankDetailsSurveyWord extends Text
{
    /**
     * @var string
     */
    public $userAnswer = null;

    public $correct;

    public function initFromXmlNode(DOMElement $node)
    {
        parent::initFromXmlNode($node);

        if ($node->hasAttribute('userAnswer')) {
            $this->userAnswer = trim($node->getAttribute('userAnswer'));
            $this->correct = ($this->userAnswer == $this->getValue());
        }
    }
}
