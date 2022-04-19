<?php

namespace BeeAZZ\NightVision;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase{
  
  public function onEnable(): void{
    $this->saveDefaultConfig();
  }
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
   switch($cmd->getName()){
    case "vision":
     if(!$sender instanceof Player){
      $sender->sendMessage("Please use command in game");
        return true;
     }
     if($sender->hasPermission("nightvision.command")){
      $sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 20 * $this->getConfig()->get("effect-time"), 2, true));
      $sender->sendMessage($this->getConfig()->get("message"));
        break;
     }
    case "unvision":
      if(!$sender instanceof Player){
      $sender->sendMessage("Please use command in game");
        return true;
     }
     if($sender->hasPermission("nightvision.command")){
     if($sender->getEffects()->has(VanillaEffects::NIGHT_VISION())){
      $sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
      $sender->sendMessage($this->getConfig()->get("remove-message"));
          }
        break;
     }
      return true;
    }
    return true;
  }
}
