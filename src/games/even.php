<?php

namespace BrainGames\game;

use function BrainGames\Cli\greeting;
use function BrainGames\Cli\startGame;

const MSG_INSTRUCTIONS = 'Answer "yes" if number even otherwise answer "no".';

function runEven()
{
    $getQuestion = function ()
    {
        $question = rand(1, 20);
        return $question;
    };

    $getExpected = function ($question)
    {
        $expected = $question % 2 === 0 ? 'yes' : 'no';
        return $expected;
    };

    $name = greeting(MSG_INSTRUCTIONS);
    startGame($name, $getQuestion, $getExpected);
}
