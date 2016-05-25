<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginManager;
use pocketmine\plugin\PluginDescription;
use pocketmine\utils\Config;

use SuperCmd\Loader;

class PluginCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("plugin");
		$this->setPermission("plugin.command");
		$this->setAliases(array("splg"));
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
                $mgr = $this->plugin->getServer()->getPluginManager();
                if(isset($args[0])) {
                    switch ($args[0]) {
                        case "enable":
                            if(isset($args[1])) {
                            $plugin = $mgr->getPlugin($args[1]);
                            if ($plugin === null) {
                                $sender->sendMessage("§c$args[1] not found");
                                return true;
                                }
                            if ($plugin->isEnabled()) {
					$sender->sendMessage("§b$args[1] is already enabled");
					break;
				}
                            $mgr->enablePlugin($plugin);
                            $sender->sendMessage("§aPlugin $args[1] enabled...");
                            } else {
                                $sender->sendMessage("§c/plugin <enable or disable> <plugin>");
                            }
                            
                            break;
                        case "disable":
                            if(isset($args[1])) {
                                $pl = $mgr->getPlugin($args[1]);
                                if ($pl === null) {
                                $sender->sendMessage("§c$args[1] not found");
                                return true;
                                }
                                if (!$pl->isEnabled()) {
					$sender->sendMessage("§b$args[1] is already disabled");
                                        break;
                                }
                                $mgr->disablePlugin($pl);
                                $sender->sendMessage("§aDisable plugin $args[1]");
                            } else {
                                $sender->sendMessage("§c/plugin <enable or disable> <plugin>");
                            }
                            break;
                            
                        
                    }
                } else {
                    $sender->sendMessage("§c/plugin <enable or disable> <plugin>");
                }
                
   }
   
}

