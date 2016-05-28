<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace InvisibleSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerLoginEvent;

use pocketmine\utils\Config;

use pocketmine\entity\Effect;

class Loader extends PluginBase implements Listener{
    public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    
    @mkdir($this->getDataFolder());
    $this->config = new Config($this->getDataFolder() . "config.yml" , Config::YAML, Array(
        "InvisibleSystem" => true,
        "VIPS" => array("RedstoneAlmeida")));
    }
    
    public function JoinLogin(\pocketmine\event\player\PlayerJoinEvent $event){
        $invisiblesystem = $this->config->get("InvisibleSystem");
        $vips = $this->config->get("VIPS");
        $player = $event->getPlayer();
        $player->removeAllEffects();

        $player_name = $player->getName();
        
        if($invisiblesystem === true) {

        if(!(in_array($player_name, $vips))) {

          $player->addEffect(Effect::getEffect(14)->setAmplifier(1)->setDuration(20000*20)->setVisible(false));
        }

      }
    }
}
