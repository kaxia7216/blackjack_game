<?php

namespace BlackJack;

class Player
{
    public $name;
    public $card = [];
    public $totalScore;

    public function __construct($name, $cardInfo)
    {
        $this -> name = $name;
        $this -> card[] = $cardInfo -> cardList[$cardInfo -> getCard()];
        $this -> card[] = $cardInfo -> cardList[$cardInfo -> getCard()];
        $this -> totalScore = 0;
    }

    public function sumCardScore($points)
    {
        //カードがJ、Q、Kの時、10ポイントに変換して加算、Aは1として随時加算
        if ($points == "J" || $points == "Q" || $points == "K") {
            return $this -> totalScore += 10;
        } elseif ($points == "A") {
            if ($this -> totalScore <= 10) {
                return $this -> totalScore += 11;
            } else {
                return $this -> totalScore += 1;
            }
        } else {
            return $this -> totalScore += $points;
        }
    }
}
