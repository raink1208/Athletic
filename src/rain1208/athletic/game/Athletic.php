<?php


namespace rain1208\athletic\game;


use pocketmine\level\Level;
use pocketmine\level\Position;
use rain1208\athletic\Main;
use rain1208\athletic\models\Spot;

class Athletic
{
    private string $name;

    private Spot $start;

    /** @var Spot[] */
    private array $checkpoints;

    private Spot $goal;

    public function __construct(string $name, array $data)
    {
        $this->name = $name;

        $start = $data["start"];
        $stpos1 = new Position($start[0]["x"], $start[0]["y"], $start[0]["z"], $this->getWorld($start[0]["world"]));
        $stpos2 = new Position($start[1]["x"], $start[1]["y"], $start[1]["z"], $this->getWorld($start[1]["world"]));
        $this->start = new Spot($stpos1, $stpos2);

        foreach ($data["checkpoint"] as $checkpoint) {
            $chpos1 = new Position($checkpoint[0]["x"], $checkpoint[0]["y"], $checkpoint[0]["z"], $this->getWorld($checkpoint[0]["world"]));
            $chpos2 = new Position($checkpoint[1]["x"], $checkpoint[1]["y"], $checkpoint[1]["z"], $this->getWorld($checkpoint[1]["world"]));

            $this->checkpoints[] = new Spot($chpos1, $chpos2);
        }

        $goal = $data["goal"];
        $gpos1 = new Position($goal[0]["x"], $goal[0]["y"], $goal[0]["z"], $this->getWorld($goal[0]["world"]));
        $gpos2 = new Position($goal[1]["x"], $goal[1]["y"], $goal[1]["z"], $this->getWorld($goal[1]["world"]));
        $this->goal = new Spot($gpos1, $gpos2);
    }

    public function getWorld(string $name): Level
    {
        return Main::getInstance()->getServer()->getLevelByName($name);
    }

    public function getStart(): Spot
    {
        return $this->start;
    }

    /** @return Spot[] */
    public function getCheckPoint(): array
    {
        return $this->checkpoints;
    }

    /**
     * @param int $now
     * @return null|Spot
     */
    public function getNext(int $now): ?Spot
    {
        $points = array_merge([$this->getStart()], $this->checkpoints, [$this->getGoal()]);
        return isset($points[$now+1]) ? $points[$now+1] : null;
    }

    public function getGoal(): Spot
    {
        return $this->goal;
    }
}