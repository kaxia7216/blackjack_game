<?php
include "blackjack_class_player.php";

$cardInfo = new Card();
$you = new player("あなた", $cardInfo);
$dealer = new player("ディーラー", $cardInfo);
$blackjack = new game_blackjack;
echo $blackjack -> game_start($you, $dealer, $cardInfo);
?>