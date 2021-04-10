<?php


namespace rain1208\athletic\tasks;


use pocketmine\scheduler\Task;
use rain1208\athletic\Main;

class StartCheckTask extends Task
{
    public function onRun(int $currentTick)
    {
        foreach (Main::getInstance()->getServer()->getOnlinePlayers() as $player) {
            $block = $player->getLevel()->getBlock($player->asVector3()->subtract(0, 1));
            foreach (Main::getInstance()->getAthleticManager()->getAll() as $athletic) {
                if ($athletic->getStart()->isInside($block)) {
                    Main::getInstance()->getAthleticTask()->addPlayer($player->getName(), $athletic);
                }
            }
        }
    }
}