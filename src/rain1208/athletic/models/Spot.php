<?php


namespace rain1208\athletic\models;


use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;

class Spot
{
    private Level $world;

    private int $minX;
    private int $minY;
    private int $minZ;

    private int $maxX;
    private int $maxY;
    private int $maxZ;

    public function __construct(Position $pos1, Position $pos2)
    {
        if ($pos1->getLevel()->getId() !== $pos2->getLevel()->getId()) {
            throw new \RuntimeException("ワールドが違う2つの座標が指定されています");
        }
        $this->world = $pos1->getLevelNonNull();

        $this->minX = min($pos1->getFloorX(), $pos2->getFloorX());
        $this->minY = min($pos1->getFloorY(), $pos2->getFloorY());
        $this->minZ = min($pos1->getFloorZ(), $pos2->getFloorZ());

        $this->maxX = max($pos1->getFloorX(), $pos2->getFloorX());
        $this->maxY = max($pos1->getFloorY(), $pos2->getFloorY());
        $this->maxZ = max($pos1->getFloorZ(), $pos2->getFloorZ());
    }

    public function getMinPos(): Vector3
    {
        return new Vector3($this->minX, $this->minY, $this->minZ);
    }

    public function getMaxPos(): Vector3
    {
        return new Vector3($this->maxX, $this->maxY, $this->maxZ);
    }

    public function isInside(Position $pos): bool
    {
        if ($this->world->getId() !== $pos->getLevel()->getId())
            return false;

        if ($pos->x <= $this->minX || $pos->x >= $this->maxX)
            return false;

        if ($pos->y <= $this->minY || $pos->y >= $this->maxY)
            return false;

        if ($pos->z <= $this->minZ || $pos->z >= $this->maxZ)
            return false;

        return true;
    }
}