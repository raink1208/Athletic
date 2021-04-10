<?php


namespace rain1208\athletic;


use rain1208\athletic\game\Athletic;

class AthleticManager
{
    /** @var Athletic[] */
    private array $athletics = [];

    public function __construct()
    {
        $config = Main::getInstance()->getConfig();

        foreach ($config->getAll() as $name => $data) {
            $this->loadAthletic($name, $data);
        }
    }

    public function loadAthletic(string $name, array $data)
    {
        $this->athletics[$name] = new Athletic($name, $data);
        Main::getInstance()->getLogger()->info($name . "を読み込みました");
    }

    public function get(string $name): Athletic
    {
        return $this->athletics[$name];
    }

    /** @return Athletic[] */
    public function getAll(): array
    {
        return $this->athletics;
    }

    public function create()
    {

    }

    public function delete(string $name)
    {

    }
}

/*
 * {
 *  "name": {
 *      start: [[pos1], [pos2]]
 *      checkpoint: [[[pos1],[pos2]], [[pos1],[pos2]]...]
 *      goal: [[pos1],[pos2]]
 *   }
 * }
 *
 * pos1 = [x, y, z, world名]
 */