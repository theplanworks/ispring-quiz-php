<?php

namespace ThePLAN\IspringQuizPhp\Questions\FillInTheBlank;

class FillInTheBlankDetails extends FillInTheBlankSurveyDetails
{
    protected function createBlank()
    {
        return new FillInTheBlankDetailsBlank();
    }
}
