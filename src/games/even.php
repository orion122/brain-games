<?php

namespace BrainGames\game;

use function BrainGames\Cli\greeting;
use function BrainGames\Cli\startGame;

function runEven()
{
    $msgInstructions = 'Answer "yes" if number even otherwise answer "no".';
    
    $getQuestion = function () {
        $question = rand(1, 20);
        return $question;
    };

    $getExpected = function ($question) {
        $expected = $question % 2 === 0 ? 'yes' : 'no';
        return $expected;
    };

    $name = greeting($msgInstructions);
    startGame($name, $getQuestion, $getExpected);
}
