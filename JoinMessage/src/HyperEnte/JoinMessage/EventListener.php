<?php

namespace HyperEnte\JoinMessage;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;


class EventListener implements Listener{

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$config = new Config(JoinMessage::getMain()->getDataFolder()."joinmessages.json", Config::JSON);
		$name = $player->getName();
		if($config->get($player->getName()) == false){
			$config->set($player->getName(), ["joinmessage" => "default"]);
			$config->save();
		}
		$info = $config->get("$name");
		if($info["joinmessage"] === "default"){
			$event->setJoinMessage(str_replace("[PLAYER]", "$name", JoinMessage::getMain()->getConfig()->get("default")));
		}
		if($info["joinmessage"] !== "default"){
			$event->setJoinMessage(str_replace("[PLAYER]", "$name", $info["joinmessage"]));
		}
	}
}