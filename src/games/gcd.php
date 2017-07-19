<?php

namespace BrainGames\game\gcd;

use function BrainGames\Cli\startGame;

const INSTRUCTION = 'Find the greatest common divisor of given numbers.';


function run()
{
    $getQuestion = function () {
        $firstNum = rand(1, 20);
        $secondNum = rand(1, 20);
        return $firstNum . ' ' . $secondNum;
    };

    $getExpected = function ($question) {
        list($firstNum, $secondNum) = explode(" ", $question);
        list($greater, $lower) = bigLess($firstNum, $secondNum);
        return gcd($greater, $lower);
    };

    startGame(INSTRUCTION, $getQuestion, $getExpected);
}


function bigLess($firstNum, $secondNum)
{
    return $firstNum >= $secondNum ? [$firstNum, $secondNum] : [$secondNum, $firstNum];
}


function gcd($greater, $lower)
{
    $expected = function ($divider, $gcd) use (&$expected, $greater, $lower) {
        if ($divider > $lower) {
            return $gcd;
        }
        if (($lower % $divider === 0) && ($greater % $divider === 0)) {
            $gcd = $divider;
        }
        return $expected($divider + 1, $gcd);
    };

    return $expected(1, 1);
}
