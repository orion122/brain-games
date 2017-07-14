<?php

namespace BrainGames\game\even;

use function BrainGames\Cli\startGame;

const INSTRUCTIONS = 'Answer "yes" if number even otherwise answer "no".';

function run()
{
    $getQuestion = function () {
        $question = rand(1, 20);
        return $question;
    };


    $getExpected = function ($question) {
        $expected = $question % 2 === 0 ? 'yes' : 'no';
        return $expected;
    };


    startGame(INSTRUCTIONS, $getQuestion, $getExpected);
}
