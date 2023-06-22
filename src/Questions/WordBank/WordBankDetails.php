<?php

namespace ThePLAN\IspringQuizPhp\Questions\WordBank;

class WordBankDetails extends WordBankSurveyDetails
{
    protected function getWordTagName()
    {
        return 'word';
    }

    protected function createWord()
    {
        return new WordBankDetailsWord();
    }
}
