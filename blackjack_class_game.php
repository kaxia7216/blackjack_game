<?php

namespace BlackJack;

class GameBlackjack
{

    public $userSelect;
    public $arrayKeyLast;

    public function __construct()
    {
        echo "ブラックジャックを開始します\n";
    }

    public function gameStart($player1, $player2, $cardInfo)
    {

        echo $player1 -> name."の引いたカードは".$player1 -> card[0][0]."の".$player1 -> card[0][1]."です。\n";
        $player1 -> sumCardScore($player1 -> card[0][1]);
        echo $player1 -> name."の引いたカードは".$player1 -> card[1][0]."の".$player1 -> card[1][1]."です。\n";
        $player1 -> sumCardScore($player1 -> card[1][1]);

        echo $player2 -> name."の引いたカードは".$player2 -> card[0][0]."の".$player2 -> card[0][1]."です。\n";
        $player2 -> sumCardScore($player2 -> card[0][1]);
        $player2 -> sumCardScore($player2 -> card[1][1]);

        echo $player2 -> name."の2枚目のカードはわかりません。\n";

        //あなたのターン
        if ($this -> yourTurn($player1, $cardInfo)) { //成功:true, 失敗:falseを返す
            //なにもしない
        } else {
            return $player1 -> name."の負けです。\n";
        }

        // ディーラーのターン
        $this -> enemyTurn($player2, $cardInfo);

        // //結果発表
        echo $this -> displayResult($player1, $player2);

        return "ブラックジャックを終了します。\n";
    }

    public function yourTurn($player, $cardInfo)
    {
        echo $player -> name."の現在の得点は".$player -> totalScore."です。\n";

        while (true) {
            echo "追加のカードを引きますか？ (Y/N) \n";
            $this -> userSelect = fgetc(STDIN);

            if ($this -> userSelect == "Y") {
                $player -> card[] = $cardInfo -> cardList[$cardInfo -> getCard()];
                $this -> arrayKeyLast = array_key_last($player -> card);
                echo $player -> name."の引いたカードは".$player -> card[$this -> arrayKeyLast][0];
                echo "の".$player -> card[$this -> arrayKeyLast][1]."です。\n";
                $player -> sumCardScore($player -> card[array_key_last($player -> card)][1]);

                if ($player -> totalScore > 21) {
                    echo $player -> name."の得点が21を超えました。\n";
                    return false;
                }
            } elseif ($this -> userSelect == "N") {
                break;
            } else {
                echo "\"Y\"または\"N\"を入力してください。\n";
            }

            echo $player -> name."の現在の得点は".$player -> totalScore."です。\n";
        }

        return true;
    }

    public function enemyTurn($player, $cardInfo)
    {
        echo $player -> name."の引いた2枚目のカードは".$player -> card[1][0]."の".$player -> card[1][1]."です。\n";
        echo $player -> name."の現在の得点は".$player -> totalScore."です。\n";
        while (true) {
            if ($player -> totalScore >= 17) {
                break;
            } else {
                $player -> card[] = $cardInfo -> cardList[$cardInfo -> getCard()];
                $this -> arrayKeyLast = array_key_last($player -> card);
                echo $player -> name."の引いたカードは".$player -> card[$this -> arrayKeyLast][0];
                echo "の".$player -> card[$this -> arrayKeyLast][1]."です。\n";
                $player -> sumCardScore($player -> card[array_key_last($player -> card)][1]);
            }
        }
    }

    public function displayResult($player1, $player2)
    {
        echo $player1 -> name."の現在の得点は".$player1 -> totalScore."です。\n";
        echo $player2 -> name."の現在の得点は".$player2 -> totalScore."です。\n";

        if ($this -> checkScore($player2) === false) {
            return $player1 -> name."の勝ちです！\n";
        } elseif ($this -> checkScore($player1) < $this -> checkScore($player2)) {
            return $player1 -> name."の勝ちです！\n";
        } elseif ($this -> checkScore($player1) == $this -> checkScore($player2)) {
            return "引き分けです。\n";
        } else {
            return $player2 -> name."の勝ちです！\n";
        }
    }

    public function checkScore($player)
    {
        if ($this -> calcScore($player) < 0) {
            return false; //負け
        } else {
            return $this -> calcScore($player);
        }
    }
    
    public function calcScore($player)
    {
        return (21 - $player -> totalScore);
    }
}
