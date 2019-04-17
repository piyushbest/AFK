<?php

namespace Assassiner354\AFK;

//Important
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

//Events
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener {

  public $afk = array();
  
  public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function onQuit(PlayerQuitEvent $event) {
    $player = $event->getPlayer();
    $name = $player->getName();
    if(in_array($name, $this->afk)) {
      unset($this->afk[array_search($name, $this->afk)]);
    }
  }
  
  public function onMove(PlayerMoveEvent $event) {
    $player = $event->getPlayer();
    $name = $player->getName();
    if(in_array($name, $this->afk)) {
      unset($this->afk[array_search($name, $this->afk)]);
      $player->setDisplayName($name);
      $player->sendMessage(TF::GREEN . "You are no longer AFK!");
    }
  }
}
