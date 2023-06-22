<?php

namespace ThePLAN\IspringQuizPhp\Questions;

class QuestionType
{
    public const TRUE_FALSE = 'trueFalseQuestion';

    public const MULTIPLE_CHOICE = 'multipleChoiceQuestion';

    public const MULTIPLE_RESPOSE = 'multipleResponseQuestion';

    public const SEQUENCE = 'sequenceQuestion';

    public const NUMERIC = 'numericQuestion';

    public const FILL_IN_THE_BLANK = 'fillInTheBlankQuestionEx';

    public const LEGACY_TYPE_IN_OR_NEW_FILL_IN_THE_BLANK = 'fillInTheBlankQuestion';

    public const TYPE_IN = 'typeInQuestion';

    public const MATCHING = 'matchingQuestion';

    public const MULTIPLE_CHOICE_TEXT = 'multipleChoiceTextQuestion';

    public const WORD_BANK = 'wordBankQuestion';

    public const ESSAY = 'essayQuestion';

    public const HOTSPOT = 'hotspotQuestion';

    public const DRAG_AND_DROP_QUESTION = 'dndQuestion';

    public const YES_NO = 'yesNoQuestion';

    public const PICK_ONE = 'pickOneQuestion';

    public const PICK_MANY = 'pickManyQuestion';

    public const SHORT_ANSWER = 'shortAnswerQuestion';

    public const RANKING = 'rankingQuestion';

    public const NUMERIC_SURVEY = 'numericSurveyQuestion';

    public const MATCHING_SURVEY = 'matchingSurveyQuestion';

    public const WHICH_WORD = 'whichWordQuestion';

    public const LIKERT_SCALE = 'likertScaleQuestion';

    public const MULTIPLE_CHOICE_TEXT_SURVEY = 'multipleChoiceTextSurveyQuestion';

    public const FILL_IN_THE_BLANK_SURVEY = 'fillInTheBlankSurveyQuestion';

    public static $gradedQuestions = [
        self::TRUE_FALSE,
        self::MULTIPLE_CHOICE,
        self::MULTIPLE_RESPOSE,
        self::SEQUENCE,
        self::NUMERIC,
        self::FILL_IN_THE_BLANK,
        self::LEGACY_TYPE_IN_OR_NEW_FILL_IN_THE_BLANK,
        self::MATCHING,
        self::MULTIPLE_CHOICE_TEXT,
        self::WORD_BANK,
        self::ESSAY,
        self::HOTSPOT,
    ];

    public static $surveyQuestions = [
        self::YES_NO,
        self::PICK_ONE,
        self::PICK_MANY,
        self::SHORT_ANSWER,
        self::RANKING,
        self::NUMERIC_SURVEY,
        self::MATCHING_SURVEY,
        self::WHICH_WORD,
        self::LIKERT_SCALE,
        self::MULTIPLE_CHOICE_TEXT_SURVEY,
        self::FILL_IN_THE_BLANK_SURVEY,
    ];
}
