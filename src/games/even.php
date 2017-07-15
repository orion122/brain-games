<?php

namespace BrainGames\game\even;

use function BrainGames\Cli\startGame;

const INSTRUCTION = 'Answer "yes" if number even otherwise answer "no".';


function run()
{
    $getQuestion = function () {
        $question = rand(1, 20);
        return $question;
    };

    $getExpected = function ($question) {
        $expected =  isEven($question) ? 'yes' : 'no';
        return $expected;
    };

    startGame(INSTRUCTION, $getQuestion, $getExpected);
}


function isEven($number)
{
    return $number % 2 === 0;
}
