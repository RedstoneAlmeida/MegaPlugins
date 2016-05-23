<?php

namespace SuperCmd;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use pocketmine\utils\Config;

use SuperCmd\Commands\FlyCommand;
use SuperCmd\Commands\GameModeCommand;

class Loader extends PluginBase{
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $server = Server::getInstance();
        $this->config = new Config($this->getDataFolder() . "commands.yml" , Config::YAML, Array(
            "fly" => true,
            "gamemode" => true,
            ));
        
        if($this->config->get("fly") === true){
         $server->getCommandMap()->register('fly', new FlyCommand($this,"fly"));   
        }
        if($this->config->get("gamemode") === true){
         $server->getCommandMap()->register('gmd', new GameModeCommand($this,"gmd")); 
        }
    }
}
    
    


