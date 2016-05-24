<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;

use SuperCmd\Loader;

class GameModeCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("gmd");
		$this->setPermission("gmd.command");
		$this->setAliases(array("gmode"));
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
                if(isset($args[0])) {
                    if ($args[0] >= 0) {
                        if ($args[0] <= 3) {
                            $gm = $this->plugin->langs->get("gamemode.msg");
                            $gm = str_replace('{GM}', $args[0], $gm);
                            $sender->setGamemode($args[0]);
                            $sender->sendMessage($gm);
                            
                        }  else {
                            $gmnt = $this->plugin->langs->get("gamemode.notfound");
                            $gmnt = str_replace('{GM}', $args[0], $gmnt);
                    $sender->sendMessage($gmnt);
                }
                    
                }
                return true;
        } else {
                    $sender->sendMessage("§c/gmd <mode>");
                }
   }
   }
   
}

