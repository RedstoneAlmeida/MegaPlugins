<?php

namespace SuperCmd\Events\PlayerEvents;

use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\event\player\PlayerToggleSprintEvent;

use SuperCmd\Loader;

class PlayerToggleSprintEvent implements Listener{
    
        public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
	}
        
        public function PlayerToggleSprintEvent(PlayerToggleSprintEvent $event){
            $event->setCancelled(true);
        }
    
}
