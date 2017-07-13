<?php

namespace BrainGames\calc;

use function BrainGames\Cli\greeting;
use function BrainGames\Cli\startGame;

const MSG_INSTRUCTIONS = 'Answer "yes" if number even otherwise answer "no".';

function run()
{
    $name = greeting(MSG_INSTRUCTIONS);
    startGame($name);
}

function getQuestion()
{
    $question = rand(1, 20);
    return $question;
}

function getExpected($question)
{
    $expected = $question % 2 === 0 ? 'yes' : 'no';
    return $expected;
}
