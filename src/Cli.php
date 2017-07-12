<?php

namespace BrainGames\Cli;

use function \cli\line;
use function \cli\prompt;

const CORRECT_ANSWERS_TO_WIN = 3;

function run()
{
    line("\nWelcome to the Brain Game!");
    line('Answer "yes" if number even otherwise answer "no".' . PHP_EOL);
    $name = prompt('May I have your name?');
    line("Hello, $name!" . PHP_EOL);

    $correctAnswers = 0;

    while ($correctAnswers < CORRECT_ANSWERS_TO_WIN) {
        $number = rand(1, 20);
        line("Question: $number");

        $answer = prompt('Your answer');
        $expected = $number % 2 === 0 ? 'yes' : 'no';

        if ($answer === $expected) {
            line("Correct!");
            $correctAnswers++;
            continue;
        }

        line("'$answer' is wrong answer ;(. Correct answer was '$expected'.");
        line("Let's try again, $name!");
    }

    line("Congratulations, $name!");
}
