<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SuperCmd\Events\HideAndSeek;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Random;
use pocketmine\block\Block;

use SuperCmd\Loader;

class HideAndSeekSystem implements Listener{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
    }
    public function PlayerMoveEvent(PlayerMoveEvent $event){
        $event->getPlayer()->getLevel()->setBlock(new Vector3($event->getPlayer()->getX(), $event->getPlayer()->getY()+1, $event->getPlayer()->getZ()), new Block(20));
        
    }
    
}
