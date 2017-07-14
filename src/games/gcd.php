<?php

namespace BrainGames\game\gcd;

use function BrainGames\Cli\startGame;

const INSTRUCTIONS = 'Find the greatest common divisor of given numbers.';


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


    startGame(INSTRUCTIONS, $getQuestion, $getExpected);
}


function bigLess($a, $b)
{
    return $a >= $b ? [$a, $b] : [$b, $a];
}


function gcd($greater, $lower)
{
    $expected = function ($i, $gcd) use (&$expected, $greater, $lower) {
        if ($i > $lower) {
            return $gcd;
        }
        if (($lower % $i === 0) && ($greater % $i === 0)) {
            $gcd = $i;
        }
        return $expected($i+1, $gcd);
    };
    return $expected(1, 1);
}
