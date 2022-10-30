<?php

declare(strict_types=1);

namespace BeeAZZ\NightVision;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

	protected function onEnable(): void {
		$this->saveDefaultConfig();
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
		if (!$sender instanceof Player) {
			$sender->sendMessage("Please use command in game");
			return true;
		}
		if ($cmd->getName() == "vision") {
			$sender->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 20 * $this->getConfig()->get("effect-time"), 2, true));
			$sender->sendMessage($this->getConfig()->get("message"));
			return true;
		}
		if ($cmd->getName() == "unvision") {
			if ($sender->getEffects()->has(VanillaEffects::NIGHT_VISION())) {
				$sender->getEffects()->remove(VanillaEffects::NIGHT_VISION());
				$sender->sendMessage($this->getConfig()->get("remove-message"));
				return true;
			}
			return true;
		}
		return false;
	}
}
