<?php

declare(strict_types=1);

namespace terpz710\examplemessages;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\utils\Config;

use terpz710\messages\Messages;

class Main extends PluginBase implements Listener {

    protected function onEnable() : void{
        $this->saveResource("messages.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function join(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = new Config($this->getDataFolder() . "messages.yml");

        $player->sendMessage((string) new Messages($config, "motd"));

        $event->setJoinMessage((string) new Messages($config, "join-message", ["{name}"], [$name]));
    }

    public function quit(PlayerQuitEvent $event) : void{
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = new Config($this->getDataFolder() . "messages.yml");

        $event->setQuitMessage((string) new Messages($config, "quit-message", ["{name}"], [$name]));
    }
}