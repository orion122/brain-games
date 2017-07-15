<?php

namespace BrainGames\game\progression;

use function BrainGames\Cli\startGame;

const INSTRUCTION = 'What number is missing in this progression?';
const PROGRESSION_LENGTH = 10;


function run()
{
    $getQuestion = function () {
        $progression = generateProgression();
        $progression = hideRandomElement($progression);
        $question = implode(' ', $progression);
        return $question;
    };

    $getExpected = function ($question) {
        $expected =  findHiddenElement($question);
        return $expected;
    };

    startGame(INSTRUCTION, $getQuestion, $getExpected);
}


function generateProgression()
{
    $firstElement = rand(1, 20);
    $d = rand(1, PROGRESSION_LENGTH - 1);
    $progression = [];

    $result = function ($nextElement, $length, $progression) use (&$result, $d) {
        if ($length == PROGRESSION_LENGTH) {
            return $progression;
        }
        $progression[] = $nextElement;
        return $result($nextElement + $d, $length + 1, $progression);
    };

    return $result($firstElement, 0, $progression);
}


function hideRandomElement($progression)
{
    $randomIndex = rand(0, PROGRESSION_LENGTH - 1);
    $progression[$randomIndex] = '..';
    return $progression;
}


function findHiddenElement($question)
{
    $progression = explode(' ', $question);
    $indexOfHideElement = array_search('..', $progression);

    if ($indexOfHideElement == 0) {
        $lastElement = $progression[PROGRESSION_LENGTH - 1];
        $penultimateElement = $progression[PROGRESSION_LENGTH - 2];
        $d = $lastElement - $penultimateElement;
        $hideElement = $progression[$indexOfHideElement + 1] - $d;
    } else {
        $firstElement = $progression[0];
        $secondElement = $progression[1];
        $d = $secondElement - $firstElement;
        $hideElement = $progression[$indexOfHideElement - 1] + $d;
    }

    return $hideElement;
}
