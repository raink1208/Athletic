<?php


namespace rain1208\athletic;


use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use rain1208\athletic\tasks\AthleticTask;
use rain1208\athletic\tasks\StartCheckTask;

class Main extends PluginBase
{
    private static Main $instance;

    private AthleticManager $athleticManager;
    private AthleticTask $task;

    private Config $config;

    public static function getInstance(): Main
    {
        return self::$instance;
    }

    public function onEnable()
    {
        self::$instance = $this;
        $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);

        $this->athleticManager = new AthleticManager();

        $this->getScheduler()->scheduleRepeatingTask(new StartCheckTask(), 2);
        $this->task = new AthleticTask();
        $this->getScheduler()->scheduleRepeatingTask($this->task, 2);
    }

    public function getAthleticManager(): AthleticManager
    {
        return $this->athleticManager;
    }

    public function getAthleticTask(): AthleticTask
    {
        return $this->task;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}