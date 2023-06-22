<?php

namespace ThePLAN\IspringQuizPhp\Questions;

use DOMElement;

class AnswersCollection
{
    /**
     * @var array of string
     */
    public $answers;

    public function initFromXmlNode(DOMElement $node)
    {
        $answersCollection = TextCollection::fromXmlNode($node, 'answer');
        $this->answers = $answersCollection->toArray();
    }
}
