<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

const MSG_WELCOME = "\nWelcome to the Brain Game!";
const MSG_ANSWER = 'Your answer';
const MSG_CORRECT = 'Correct!';
const CORRECT_ANSWERS_TO_WIN = 3;


function getName()
{
    $name = prompt('May I have your name?');
    return $name;
}


function msgQuestion($question)
{
    return "Question: $question";
}


function msgWrongCorrectAnswer($answer, $expected)
{
    return "'$answer' is wrong answer ;(. Correct answer was '$expected'.";
}


function msgTryAgain($name)
{
    return "Let's try again, $name!";
}


function startGame($instructions, $getQuestion, $getExpected)
{
    line(MSG_WELCOME);
    line($instructions . PHP_EOL);

    $name = getName();
    line("Hello, $name" . PHP_EOL);

    $correctAnswers = 0;

    while ($correctAnswers < CORRECT_ANSWERS_TO_WIN) {
        $question = $getQuestion();
        line(msgQuestion($question));
        $answer = prompt(MSG_ANSWER);
        $expected = $getExpected($question);

        if ($answer == $expected) {
            line(MSG_CORRECT);
            $correctAnswers++;
            continue;
        }

        line(msgWrongCorrectAnswer($answer, $expected));
        line(msgTryAgain($name));
    }

    line("Congratulations, $name!");
}
