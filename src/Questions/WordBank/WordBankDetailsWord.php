<?php

namespace ThePLAN\IspringQuizPhp\Questions\WordBank;

use DOMElement;

class WordBankDetailsWord extends WordBankDetailsSurveyWord
{
    /**
     * @var bool
     */
    public $correct = false;

    public function WordBankDetailsWord($value = '')
    {
        parent::__construct($value);
    }

    public function initFromXmlNode(DOMElement $node)
    {
        parent::initFromXmlNode($node);

        $this->correct = $node->getAttribute('correct') == 'true';
    }
}
