<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

const MSG_WELCOME = "\nWelcome to the Brain Game!";
const MSG_ASK_NAME = 'May I have your name?';
const MSG_ANSWER = 'Your answer';
const MSG_CORRECT = 'Correct!';
const CORRECT_ANSWERS_TO_WIN = 3;


function init($instructions)
{
    line(MSG_WELCOME);
    line($instructions . PHP_EOL);
}


function getName()
{
    $name = prompt(MSG_ASK_NAME);
    return $name;
}


function msgQuestion($question)
{
    line("Question: $question");
}


function msgWrongAnswer($name, $answer, $expected)
{
    line("'$answer' is wrong answer ;(. Correct answer was '$expected'.");
    line("Let's try again, $name!");
}


function congratulations($name)
{
    line("Congratulations, $name!");
}


function startGame($instructions, $getQuestion, $getExpected)
{
    init($instructions);

    $name = getName();
    line("Hello, $name" . PHP_EOL);

    $correctAnswers = 0;

    while ($correctAnswers < CORRECT_ANSWERS_TO_WIN) {
        $question = $getQuestion();
        msgQuestion($question);
        $answer = prompt(MSG_ANSWER);
        $expected = $getExpected($question);

        if ($answer == $expected) {
            line(MSG_CORRECT);
            $correctAnswers++;
            continue;
        }

        msgWrongAnswer($name, $answer, $expected);
    }

    congratulations($name);
}
