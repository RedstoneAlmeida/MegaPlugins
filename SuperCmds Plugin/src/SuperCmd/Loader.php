<?php

namespace SuperCmd;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use pocketmine\utils\Config;

use SuperCmd\Commands\FlyCommand;
use SuperCmd\Commands\GameModeCommand;
use SuperCmd\Commands\EffectCommand;
use SuperCmd\Commands\MotdCommand;

class Loader extends PluginBase{
    
    public function onEnable(){
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . "langs/");
        @mkdir($this->getDataFolder() . "hints/");
        $server = Server::getInstance();
        $this->config = new Config($this->getDataFolder() . "commands.yml" , Config::YAML, Array(
            "fly" => true,
            "gamemode" => true,
            "effect" => true,
            "motd.cmd" => true,
            ));
        $this->default = new Config($this->getDataFolder() . "config.yml" , Config::YAML, Array(
            "languages.folder" => "en_us",
            "hint.folder" => true,
            "console.msg" => "§cRun command in game",
            "motd.system" => true,
            "motd" => "Testing Motd",
            ));
        $langs = $this->default->get("languages.folder");
        $this->langs = new Config($this->getDataFolder() . "langs/" . $langs.".yml" , Config::YAML, Array(
            "fly.msg.off" => "§bFly Off",
            "fly.msg.on" => "§bFly On",
            "effect.msg.use" => "§bYou gived effect {EFFECT} * {AMP} for {SECONDS} seconds",
            "gamemode.msg" => "§bChanged Gamemode to {GM}",
            "gamemode.notfound" => "§bGameMode {GM} not found",
            ));
        $this->saveResource("langs/pt_br-example.yml");
        $this->getLogger()->info("§b*§7-§b*§7-§b*§7-§b*§7-§b*§7-§b*");
        $this->getLogger()->info(" ");
        $this->getLogger()->info(" ");
        if($this->config->get("fly") === true){
         $server->getCommandMap()->register('fly', new FlyCommand($this,"fly"));   
         $this->getLogger()->info("§aFly is Enabled...");
        }
        if($this->config->get("gamemode") === true){
         $server->getCommandMap()->register('gmd', new GameModeCommand($this,"gmd")); 
         $this->getLogger()->info("§aGamemode is Enabled...");
        }
        if($this->config->get("effect") === true){
         $server->getCommandMap()->register('seffect', new EffectCommand($this,"seffect")); 
         $this->getLogger()->info("§aSEffect is Enabled...");
        }
        if($this->config->get("motd.cmd") === true){
         $server->getCommandMap()->register('motd', new MotdCommand($this,"motd")); 
         $this->getLogger()->info("§aMotdCMD is Enabled...");
        }
        if($this->config->get("fly") === true){
            if($this->config->get("gamemode") === true){
                if($this->config->get("effect") === true){
                    if($this->config->get("motd.cmd") === true){
                    $this->getLogger()->info(" ");
                    $this->getLogger()->info("§aALL Commands Enabled...");
                    }
                    
                }
            }
        }
        if($this->default->get("hint.folder") === true){
            $this->saveResource("hints/Effects.php");
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aHints Enabled...");
        }
        
        if($this->default->get("motd.system") === true){
            $motd = $this->default->get("motd");
            $this->getServer()->getNetwork()->setName($motd);
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aMotd Enabled...");
        }
        
        $this->getLogger()->info(" ");
        $this->getLogger()->info(" ");
        $this->getLogger()->info("§b*§7-§b*§7-§b*§7-§b*§7-§b*§7-§b*");
    }
}
    
    


