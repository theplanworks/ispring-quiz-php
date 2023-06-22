<?php

namespace ThePLAN\IspringQuizPhp;

use DOMElement;
use DOMDocument;
use ThePLAN\IspringQuizPhp\Utils\Version;
use ThePLAN\IspringQuizPhp\Utils\XmlUtils;
use ThePLAN\IspringQuizPhp\Questions\QuestionType;
use ThePLAN\IspringQuizPhp\Questions\Essay\EssayQuestion;
use ThePLAN\IspringQuizPhp\Questions\TypeIn\TypeInQuestion;
use ThePLAN\IspringQuizPhp\Questions\Hotspot\HotspotQuestion;
use ThePLAN\IspringQuizPhp\Questions\Numeric\NumericQuestion;
use ThePLAN\IspringQuizPhp\Questions\Matching\MatchingQuestion;
use ThePLAN\IspringQuizPhp\Questions\Sequence\SequenceQuestion;
use ThePLAN\IspringQuizPhp\Questions\WordBank\WordBankQuestion;
use ThePLAN\IspringQuizPhp\Questions\TrueFalse\TrueFalseQuestion;
use ThePLAN\IspringQuizPhp\Questions\TypeIn\TypeInSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\DragNDrop\DragAndDropQuestion;
use ThePLAN\IspringQuizPhp\Questions\Numeric\NumericSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\LikertScale\LikertScaleQuestion;
use ThePLAN\IspringQuizPhp\Questions\Matching\MatchingSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\Sequence\SequenceSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\WordBank\WordBankSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\TrueFalse\TrueFalseSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\FillInTheBlank\FillInTheBlankQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleChoice\MultipleChoiceQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleResponse\MultipleResponseQuestion;
use ThePLAN\IspringQuizPhp\Questions\FillInTheBlank\FillInTheBlankSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleChoice\MultipleChoiceSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleChoiceText\MultipleChoiceTextQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleResponse\MultipleResponseSurveyQuestion;
use ThePLAN\IspringQuizPhp\Questions\MultipleChoiceText\MultipleChoiceTextSurveyQuestion;

class iSpringQuiz
{
    public const XSD_CURRENT = "QuizReport.xsd";
    public const XSD_OLDER_THAN_9 = "QuizReport_8.xsd";
    public const VERSION_9 = '9.0';
    public const FINISH_TIMESTAMP_ATTRIBUTE = 'finishTimestamp';
    public const IS_TEST_PASSED_ATTRIBUTE = 'passed';
    public const PASSING_PERCENT_TAG = 'passingPercent';
    public const STUDENT_PERCENT_ATTRIBUTE = 'percent';
    public const TYPE_IN_RENAMED_IN_VERSION = '9.0';

    /** @var string|null */
    public $finishedAt;

    /** @var Question[] */
    public $questions;

    /** @var bool|null */
    public $isTestPassed = null;

    /** @var float|null */
    public $studentPercent = null;

    /** @var float|null  */
    public $passingPercent = null;

    public function parseQuizXml(string $xml, string $version)
    {
        libxml_use_internal_errors(true);
        $xsdFileName = $this->GetSchemaByVersion($version);

        // dump($xsdFileName);
        // die();

        $doc = new DOMDocument('1.0', 'utf8');

        $doc->loadXML($xml);

        // validate xml
        if (!$doc->schemaValidate($xsdFileName)) {
            error_log(var_export(libxml_get_errors(), true));
            return false;
        }

        $summaryNode = $doc->getElementsByTagName('summary')->item(0);
        if ($summaryNode) {
            if ($summaryNode->hasAttribute(self::FINISH_TIMESTAMP_ATTRIBUTE)) {
                $this->finishedAt = $summaryNode->getAttribute(self::FINISH_TIMESTAMP_ATTRIBUTE);
            }
            $this->isTestPassed = XmlUtils::getElementBooleanAttribute($summaryNode, self::IS_TEST_PASSED_ATTRIBUTE);
            if ($summaryNode->hasAttribute(self::STUDENT_PERCENT_ATTRIBUTE)) {
                $this->studentPercent = $summaryNode->getAttribute(self::STUDENT_PERCENT_ATTRIBUTE);
            }
        }

        $passingPercentNode = $doc->getElementsByTagName(self::PASSING_PERCENT_TAG)->item(0);
        if ($passingPercentNode) {
            $this->passingPercent = $passingPercentNode->textContent;
        }

        $questionsNode = $doc->getElementsByTagName('questions')->item(0);
        $this->exportQuestions($questionsNode, $version);

        return [
            'finished_at' => $this->finishedAt,
            'questions' => $this->questions,
            'is_test_passed' => $this->isTestPassed,
            'student_percent' => $this->studentPercent,
            'passing_percent' => $this->passingPercent,
        ];
    }

    /**
     * @param DOMElement $questionsNode
     * @param string $version
     */
    private function exportQuestions(DOMElement $questionsNode, $version)
    {
        foreach ($questionsNode->childNodes as $questionNode) {
            if (!$questionNode instanceof DOMElement) {
                continue;
            }

            $question = self::CreateFromXmlNode($questionNode, $version);
            if ($question) {
                $this->questions[] = $question;
            }
        }
    }

    /**
     * @param string $version
     * @return string
     */
    private function GetSchemaByVersion($version)
    {
        $validationSchema = self::XSD_OLDER_THAN_9;
        if (Version::IsVersionNewerOrSameAs($version, self::VERSION_9)) {
            $validationSchema = self::XSD_CURRENT;
        }
        return __DIR__ . '/' . $validationSchema;
    }

    public static function CreateFromXmlNode(DOMElement $questionNode, $version)
    {
        $question = null;

        switch ($questionNode->nodeName) {
            case QuestionType::TRUE_FALSE:
                $question = new TrueFalseQuestion();
                break;
            case QuestionType::MULTIPLE_CHOICE:
                $question = new MultipleChoiceQuestion();
                break;
            case QuestionType::MULTIPLE_RESPOSE:
                $question = new MultipleResponseQuestion();
                break;
            case QuestionType::SEQUENCE:
                $question = new SequenceQuestion();
                break;
            case QuestionType::FILL_IN_THE_BLANK:
                $question = new FillInTheBlankQuestion();
                break;
            case QuestionType::LEGACY_TYPE_IN_OR_NEW_FILL_IN_THE_BLANK:
                if (Version::IsVersionOlderThan($version, self::TYPE_IN_RENAMED_IN_VERSION)) {
                    $question = new TypeInQuestion();
                } else {
                    $question = new FillInTheBlankQuestion();
                }
                break;
            case QuestionType::TYPE_IN:
                $question = new TypeInQuestion();
                break;
            case QuestionType::MATCHING:
                $question = new MatchingQuestion();
                break;
            case QuestionType::NUMERIC:
                $question = new NumericQuestion();
                break;
            case QuestionType::MULTIPLE_CHOICE_TEXT:
                $question = new MultipleChoiceTextQuestion();
                break;
            case QuestionType::WORD_BANK:
                $question = new WordBankQuestion();
                break;
            case QuestionType::ESSAY:
                $question = new EssayQuestion();
                break;
            case QuestionType::HOTSPOT:
                $question = new HotspotQuestion();
                break;
            case QuestionType::YES_NO:
                $question = new TrueFalseSurveyQuestion();
                break;
            case QuestionType::PICK_ONE:
                $question = new MultipleChoiceSurveyQuestion();
                break;
            case QuestionType::PICK_MANY:
                $question = new MultipleResponseSurveyQuestion();
                break;
            case QuestionType::SHORT_ANSWER:
                $question = new TypeInSurveyQuestion();
                break;
            case QuestionType::RANKING:
                $question = new SequenceSurveyQuestion();
                break;
            case QuestionType::NUMERIC_SURVEY:
                $question = new NumericSurveyQuestion();
                break;
            case QuestionType::MATCHING_SURVEY:
                $question = new MatchingSurveyQuestion();
                break;
            case QuestionType::WHICH_WORD:
                $question = new WordBankSurveyQuestion();
                break;
            case QuestionType::LIKERT_SCALE:
                $question = new LikertScaleQuestion();
                break;
            case QuestionType::MULTIPLE_CHOICE_TEXT_SURVEY:
                $question = new MultipleChoiceTextSurveyQuestion();
                break;
            case QuestionType::FILL_IN_THE_BLANK_SURVEY:
                $question = new FillInTheBlankSurveyQuestion();
                break;
            case QuestionType::DRAG_AND_DROP_QUESTION:
                $question = new DragAndDropQuestion();
                break;
        }

        if ($question != null) {
            $question->initFromXmlNode($questionNode);
        }

        return $question;
    }
}
