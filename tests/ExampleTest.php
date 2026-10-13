<?php

use ThePLAN\IspringQuizPhp\Questions\TypeIn\TypeInQuestion;

it('preserves type-in responses without acceptable answers', function ($evaluationAttribute, $isGraded) {
    $document = new DOMDocument();
    $document->loadXML('<typeInQuestion '.$evaluationAttribute.' userAnswer=" Survey response " awardedPoints="0"><direction>Enter a response</direction></typeInQuestion>');
    $question = new TypeInQuestion();

    $question->initFromXmlNode($document->documentElement);

    expect($question->userAnswer)->toBe('Survey response')
        ->and($question->correctAnswer)->toBeNull()
        ->and($question->direction)->toBe('Enter a response')
        ->and($question->isGraded())->toBe($isGraded)
        ->and($question->awardedPoints)->toBe($isGraded ? '0' : null);
})->with([
    'survey' => ['evaluationEnabled="false"', false],
    'graded' => ['evaluationEnabled="true"', true],
    'default grading' => ['', true],
]);

it('parses type-in acceptable answers', function ($answersXml, $correctAnswer) {
    $document = new DOMDocument();
    $document->loadXML('<typeInQuestion userAnswer="First"><direction>Enter a response</direction><acceptableAnswers>'.$answersXml.'</acceptableAnswers></typeInQuestion>');
    $question = new TypeInQuestion();

    $question->initFromXmlNode($document->documentElement);

    expect($question->userAnswer)->toBe('First')
        ->and($question->correctAnswer)->toBe($correctAnswer);
})->with([
    'empty' => ['', null],
    'multiple answers' => ['<answer> First </answer><answer> Second </answer>', 'First; Second'],
]);
