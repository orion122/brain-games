<?php

namespace BrainGames\game\prime;

use function BrainGames\Cli\startGame;

const INSTRUCTION = 'Answer "yes" if number is prime otherwise answer "no".';


function run()
{
    $getQuestion = function () {
        $question = rand(1, 20);
        return $question;
    };

    $getExpected = function ($question) {
        $expected =  isPrime($question) ? 'yes' : 'no';
        return $expected;
    };

    startGame(INSTRUCTION, $getQuestion, $getExpected);
}


function isPrime($question)
{
    if ((int)$question <= 2) {
        return true;
    }

    $result = function ($divider) use (&$result, $question) {
        if ($question % $divider == 0) {
            return false;
        } elseif ($divider >= $question / 2) {
            return true;
        }
        return $result($divider + 1);
    };

    return $result(2);
}
