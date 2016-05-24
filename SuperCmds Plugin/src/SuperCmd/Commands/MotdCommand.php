<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\Server;

use SuperCmd\Loader;

class MotdCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("motd");
		$this->setPermission("motd.command");
		$this->setAliases(array("smotd"));
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
                if($sender->isOp()){
                    $motd = implode(" ", $args);
                    $this->plugin->default->set("motd",$motd);
                    $this->plugin->default->save();
                    $sender->sendMessage("§cUse /reload to reload MOTD");
                }
   }
   
}

