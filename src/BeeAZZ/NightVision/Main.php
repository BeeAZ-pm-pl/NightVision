<?php

namespace BeeAZZ\NightVision;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase implements Listener{
  
  public function onEnable(): void{
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->saveDefaultConfig();
    
  }
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
   switch($cmd->getName()){
    case "nightvision":
     if(!$sender instanceof Player){
      $sender->sendMessage("Please use command in game");
        return true;
     }
     if($sender->hasPermission("nightvision.command")){
      $sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 20 * $this->getConfig()->get("effect-time"), 2, true));
      $sender->sendMessage($this->getConfig()->get("message"));
        break;
     }
    }
    return true;
  }
}
