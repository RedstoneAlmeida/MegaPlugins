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
	$server->getCommandMap()->register('fly', new FlyCommand($this,"fly"));
        $server->getCommandMap()->register('gmd', new GameModeCommand($this,"gmd"));
    }
}
    
    


