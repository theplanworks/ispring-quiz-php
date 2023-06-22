<?php

namespace ThePLAN\IspringQuizPhp\Questions\MultipleChoiceText;

class MultipleChoiceTextDetails extends MultipleChoiceTextSurveyDetails
{
    protected function createBlank()
    {
        return new MultipleChoiceTextDetailsBlank();
    }
}
