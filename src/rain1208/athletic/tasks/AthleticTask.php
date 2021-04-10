<?php


namespace rain1208\athletic\tasks;


use pocketmine\scheduler\Task;
use rain1208\athletic\game\Athletic;
use rain1208\athletic\game\AthleticPlayer;

class AthleticTask extends Task
{
    /** @var AthleticPlayer[] */
    private array $players = [];

    public function addPlayer(string $name, Athletic $athletic)
    {
        $this->players[$name] = new AthleticPlayer($name ,$athletic);
    }

    public function removePlayer(string $name)
    {
        if (isset($this->players[$name])) {
            unset($this->players[$name]);
        }
    }

    public function onRun(int $currentTick)
    {
        foreach ($this->players as $name => $athleticPlayer) {
            $athleticPlayer->baseTick();
        }
    }
}