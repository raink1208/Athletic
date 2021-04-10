<?php


namespace rain1208\athletic\game;


use pocketmine\Player;
use rain1208\athletic\Main;
use rain1208\athletic\models\Spot;

class AthleticPlayer
{
    private string $name;
    private Athletic $athletic;
    private int $now;

    public function __construct(string $name, Athletic $athletic)
    {
        $this->name = $name;
        $this->athletic = $athletic;
        $this->now = 0;

    }

    public function baseTick()
    {
        $player = Main::getInstance()->getServer()->getPlayer($this->name);
        if (!$player->isOnline()) return;

        $next = $this->athletic->getNext($this->now);
        if ($next === null) {
            Main::getInstance()->getAthleticTask()->removePlayer($this->name);
            return;
        }

        if ($this->compare($player, $next)) {
            $this->now++;
            var_dump("checkpoint");
        }
    }

    private function compare(Player $player, Spot $next): bool
    {
        return $next->isInside($player);
    }
}