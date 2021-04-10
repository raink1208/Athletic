<?php


namespace rain1208\athletic\events;


use pocketmine\event\player\PlayerEvent;
use rain1208\athletic\game\Athletic;

abstract class AthleticEvent extends PlayerEvent
{
    protected Athletic $athletic;

    public function getAthletic(): Athletic
    {
        return $this->athletic;
    }
}