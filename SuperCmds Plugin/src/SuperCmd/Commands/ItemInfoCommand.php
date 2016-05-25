<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\Server;

use pocketmine\item\Item;

use SuperCmd\Loader;

class ItemInfoCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("iinfo");
		$this->setPermission("iteminfo.command");
		$this->setAliases(array("siinfo"));
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
                    $item = $sender->getInventory()->getItemInHand();
                    if ($item->getId() == Item::AIR) {
                        $sender->sendMessage("§cYou is not holding item");
                        return true;
                    }
                    $sender->sendMessage("§aItemId: §b".$item->getId());
                    $sender->sendMessage("§aCount: §b".$item->getCount());
                    $sender->sendMessage("§aDamage: §b".$item->getDamage());
                    
                } else {
                    $sender->sendMessage($this->plugin->default->get("console.msg"));
                }
   }
   
}

