<?php

namespace BrainGames\Cli;

use function BrainGames\calc\getExpected;
use function BrainGames\calc\getQuestion;
use function \cli\line;
use function \cli\prompt;

const MSG_WELCOME = "\nWelcome to the Brain Game!";
const MSG_ANSWER = 'Your answer';
const MSG_CORRECT = 'Correct!';
const CORRECT_ANSWERS_TO_WIN = 3;


function msgAskName()
{
    $name = prompt('May I have your name?');
    return $name;
}

function msgGreet($name)
{
    return function () use ($name) {
        return "Hello, $name!";
    };
}

function msgQuestion($question)
{
    return function () use ($question) {
        return "Question: $question";
    };
}

function msgWrongCorrectAnswer($answer, $expected)
{
    return function () use ($answer, $expected) {
        return "'$answer' is wrong answer ;(. Correct answer was '$expected'.";
    };
}

function msgTryAgain($name)
{
    return function () use ($name) {
        return "Let's try again, $name!";
    };
}

function msgCongratulations($name)
{
    return function () use ($name) {
        return "Congratulations, $name!";
    };
}

function startGame($name)
{
    $correctAnswers = 0;

    while ($correctAnswers < CORRECT_ANSWERS_TO_WIN) {
        $question = getQuestion();
        line(msgQuestion($question));
        $answer = prompt(MSG_ANSWER);
        $expected = getExpected($question);

        if ($answer === $expected) {
            line(MSG_CORRECT);
            $correctAnswers++;
            continue;
        }

        line(msgWrongCorrectAnswer($answer, $expected));
        line(msgTryAgain($name));
    }

    line(msgCongratulations($name));
}

function greeting($msgInstructions)
{
    line(MSG_WELCOME);
    line($msgInstructions . PHP_EOL);
    $name = msgAskName();
    line(msgGreet($name) . PHP_EOL);

    return $name;
}
