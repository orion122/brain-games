<?php

namespace BrainGames\Cli;

use function BrainGames\game\runCalc;
use function BrainGames\game\runEven;
use function cli\line;
use function cli\prompt;

function run($game)
{
    welcome();
    if ($game === 'even') {
        showInstructions('Answer "yes" if number even otherwise answer "no".');
        $name = getName();
        greeting($name);
        runEven($name);
        congratulations($name);
    } elseif ($game === 'calc') {
        showInstructions('What is the result of the expression?');
        $name = getName();
        greeting($name);
        runCalc($name);
        congratulations($name);
    }
}


function welcome()
{
    line("\nWelcome to the Brain Game!");
}


function showInstructions($instructions)
{
    line($instructions . PHP_EOL);
}


function getName()
{
    $name = prompt('May I have your name?');
    return $name;
}


function greeting($name)
{
    line("Hello, $name" . PHP_EOL);
}


function congratulations($name)
{
    return "Congratulations, $name!";
}
