<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;

use SuperCmd\Loader;

class FlyCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("fly");
		$this->setPermission("fly.command");
		$this->setAliases(array("flyght"));
	}
        
     /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param string[] $args
     *
     * @return mixed
     */
   public function execute(CommandSender $sender, $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}
                if($sender instanceof Player){
                if ($sender->getAllowFlight()){
                    $sender->sendMessage($this->plugin->langs->get("fly.msg.off"));
                    $sender->setAllowFlight(false);
                } else {
                    $sender->sendMessage($this->plugin->langs->get("fly.msg.on"));
                    $sender->setAllowFlight(true);
                }
                } else {
                    $sender->sendMessage($this->plugin->default->get("console.msg"));
                }
   }
   
}

