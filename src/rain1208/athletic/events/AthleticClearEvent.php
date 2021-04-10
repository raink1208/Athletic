<?php


namespace rain1208\athletic\events;


use pocketmine\Player;
use rain1208\athletic\game\Athletic;

class AthleticClearEvent extends AthleticEvent
{
    public function __construct(Player $player, Athletic $athletic)
    {
        $this->player = $player;
        $this->athletic = $athletic;
    }
}