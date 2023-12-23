<?php

namespace BlackJack;

require_once(__DIR__ . '/blackjack_class_game.php');
require_once(__DIR__ . '/blackjack_class_player.php');
require_once(__DIR__ . '/blackjack_class_card.php');

$cardInfo = new Card();
$you = new Player("あなた", $cardInfo);
$dealer = new Player("ディーラー", $cardInfo);
$blackjack = new GameBlackjack();
echo $blackjack -> gameStart($you, $dealer, $cardInfo);
