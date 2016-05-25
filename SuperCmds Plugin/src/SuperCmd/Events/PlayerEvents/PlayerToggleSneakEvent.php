<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SuperCmd\Events\PlayerEvents;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerToggleSneakEvent;

use SuperCmd\Loader;

class PlayerToggleSneakEvent implements Listener{
    
        public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
	}
        
        public function PlayerToggleSneakEvent(PlayerToggleSneakEvent $event){
            $event->setCancelled(true);
        }
}
