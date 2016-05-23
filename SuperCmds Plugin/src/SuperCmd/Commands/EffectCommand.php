<?php

namespace SuperCmd\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;

use pocketmine\entity\Effect;

use SuperCmd\Loader;

class EffectCommand extends Command{
    
    public function __construct(Loader $plugin) {
		$this->plugin = $plugin;
                
                parent::__construct("seffect");
		$this->setPermission("effect.command");
		$this->setAliases(array("sceffecter"));
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
                    switch ($args[0]) {
                        case "$args[0]":
                        if(isset($args[1])) {
                            switch ($args[1]) {
                                case "$args[1]":
                                    if(isset($args[2])) {
                                        switch ($args[2]) {
                                            case "$args[2]":
                                                $sender->getPlayer()->addEffect(Effect::getEffect($args[0])->setAmplifier($args[1])->setDuration($args[2]*20)->setVisible(false));
                                                $sender->sendMessage("§aVocê adicionou o efeito $args[0] * $args[1] por $args[2]s");
                                                return true;
                                        } 

                                    } else {
                                        $sender->sendMessage("§cEstá faltando a duração!");
                                    }
                            }
                            
                        } else {
                            $sender->sendMessage("§cEstá faltando o Amplifier e Duração!");
                        }
                        
                    }
        } else {
            $sender->sendMessage("§cEstá faltando o Efeito, Amplifier e Duração!");
        }
   }
   
}

