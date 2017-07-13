<?php

namespace BrainGames\game;

use function BrainGames\common\greeting;
use function BrainGames\common\startGame;

function runEven($name)
{
    $getQuestion = function () {
        $question = rand(1, 20);
        return $question;
    };


    $getExpected = function ($question) {
        $expected = $question % 2 === 0 ? 'yes' : 'no';
        return $expected;
    };


    startGame($name, $getQuestion, $getExpected);
}
