<?php

namespace HyperEnte\JoinMessage;

use HyperEnte\JoinMessage\commands\JoinMessageCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;


class JoinMessage extends PluginBase{

	private static $main;

	public function onEnable(){
		self::$main = $this;
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$config = new Config($this->getDataFolder()."joinmessages.json", Config::JSON);
		$config->save();
		$this->getServer()->getCommandMap()->registerAll("JoinMessage",
		[
			new JoinMessageCommand()
		]);
	}
	public static function getMain(): self{
		return self::$main;
	}
}