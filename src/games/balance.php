<?php

namespace BrainGames\game\balance;

use function BrainGames\Cli\startGame;

const INSTRUCTION = 'Balance the given number.';


function run()
{
    $getQuestion = function () {
        $question = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return $question;
    };

    $getExpected = function ($question) {
        return balance(str_split($question));
    };

    startGame(INSTRUCTION, $getQuestion, $getExpected);
}


function balance($numbers)
{
    $result = function ($nums, $indexMin, $indexMax) use (&$result) {
        list($indexMin, $indexMax) = indexOfMaxAndMin($nums);
        if ($nums[$indexMax] - $nums[$indexMin] < 2) {
            return $nums;
        }
        $nums[$indexMax]--;
        $nums[$indexMin]++;
        list($indexMin, $indexMax) = indexOfMaxAndMin($nums);
        return $result($nums, $indexMin, $indexMax);
    };

    $expected = $result($numbers, 0, 0);
    sort($expected);
    return implode($expected);
}


function indexOfMaxAndMin($numbers)
{
    $maxNum = max($numbers);
    $minNum = min($numbers);
    $indexOfMin = array_search($minNum, $numbers);
    $indexOfMax = array_search($maxNum, $numbers);
    return [$indexOfMin, $indexOfMax];
}
