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
                if(isset($args[0])) {
                    if ($args[0] !== $sender->getGamemode()) {
                            $sender->setGamemode($args[0]);
                            $sender->sendMessage("§bSeu modo de jogo foi alterado para ".$args[0]);
                    
                }
                return true;
        } else {
                    $sender->sendMessage("§c/gmd <mode>");
                }
   }
   
}

