<?php

namespace BrainGames\game\calc;

use function BrainGames\Cli\startGame;

const INSTRUCTIONS = 'What is the result of the expression?';

function run()
{
    $getQuestion = function () {
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        $arrayOfOperations = ['+', '-', '*'];
        $randomOperation = $arrayOfOperations[rand(0, 2)];
        $question = $randomNumber1 . ' ' . $randomOperation . ' ' . $randomNumber2;
        return $question;
    };


    $getExpected = function ($question) {
        $expected = function () use ($question) {
            if (strpos($question, '+') !== false) {
                return firstNum($question, '+') + secondNum($question);
            } elseif (strpos($question, '-') !== false) {
                return firstNum($question, '-') - secondNum($question);
            }
            return firstNum($question, '*') * secondNum($question);
        };
        return $expected();
    };

    startGame(INSTRUCTIONS, $getQuestion, $getExpected);
}


function firstNum($question, $operation)
{
    return strstr($question, $operation, true);
}


function secondNum($question)
{
    return substr($question, (strrpos($question, ' ')));
}
