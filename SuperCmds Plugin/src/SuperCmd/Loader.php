<?php

namespace SuperCmd;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\Server;

use pocketmine\Player;

use pocketmine\scheduler\CallbackTask;

use pocketmine\entity\Effect;

use pocketmine\utils\Config;

use SuperCmd\Commands\FlyCommand;
use SuperCmd\Commands\GameModeCommand;
use SuperCmd\Commands\EffectCommand;
use SuperCmd\Commands\MotdCommand;
use SuperCmd\Commands\PluginCommand;
use SuperCmd\Commands\ItemInfoCommand;

use SuperCmd\Events\PlayerEvents\PlayerToggleSprintEvent;
use SuperCmd\Events\PlayerEvents\PlayerToggleSneakEvent;


class Loader extends PluginBase implements Listener{
    
    public function onEnable(){
        $plevents = $this->getServer()->getPluginManager();
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . "langs/");
        @mkdir($this->getDataFolder() . "hints/");
        $server = Server::getInstance();
        $this->config = new Config($this->getDataFolder() . "commands.yml" , Config::YAML, Array(
            "fly" => true,
            "gamemode" => true,
            "effect" => true,
            "motd.cmd" => true,
            "plugin.cmd" => true,
            "iteminfo.cmd" => true,
            ));
        $this->events = new Config($this->getDataFolder() . "events.yml" , Config::YAML, Array(
            "allow.sprint" => false,
            "allow.shift" => false,
            ));
        $this->default = new Config($this->getDataFolder() . "config.yml" , Config::YAML, Array(
            "languages.folder" => "en_us",
            "hint.folder" => true,
            "console.msg" => "§cRun command in game",
            "motd.system" => true,
            "motd" => "Testing Motd [{ONPLAYERS}/{MAXPLAYERS}]",
            "hunger" => false,
            "use.regeneration.system" => true,
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
        if($this->config->get("plugin.cmd") === true){
         $server->getCommandMap()->register('plugin', new PluginCommand($this,"plugin")); 
         $this->getLogger()->info("§aPluginCMD is Enabled...");
        }
        if($this->config->get("iteminfo.cmd") === true){
         $server->getCommandMap()->register('iinfo', new ItemInfoCommand($this,"iinfo")); 
         $this->getLogger()->info("§aItemInfo is Enabled...");
        }
        if($this->config->get("fly") === true){
            if($this->config->get("gamemode") === true){
                if($this->config->get("effect") === true){
                    if($this->config->get("motd.cmd") === true){
                        if($this->config->get("plugin.cmd") === true){
                            if($this->config->get("iteminfo.cmd") === true){
                    $this->getLogger()->info(" ");
                    $this->getLogger()->info("§aALL Commands Enabled...");
                            }
                        }
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
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "motdsystem")), 10);
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aMotd Enabled...");
        }
        if($this->default->get("hunger") === false){
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "hunger")), 10);
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aHunger Enabled...");
        }
        if($this->events->get("allow.speed") === false){
            $plevents->registerEvents(new PlayerToggleSprintEvent($this), $this);
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aEvents: SprintOFF Enabled...");
        }
        if($this->events->get("allow.shift") === false){
            $plevents->registerEvents(new PlayerToggleSneakEvent($this), $this);
            $this->getLogger()->info("§aEvents: SneakOFF Enabled...");
        }
        
        $this->getLogger()->info(" ");
        $this->getLogger()->info(" ");
        $this->getLogger()->info("§b*§7-§b*§7-§b*§7-§b*§7-§b*§7-§b*");
    }
    
    public function motdsystem(){
 		if($this->default->get("motd.system") === true){
                    $motd = $this->default->get("motd");
                    $motd = str_replace('{ONPLAYERS}', count($this->getServer()->getOnlinePlayers()), $motd);
                    $motd = str_replace('{MAXPLAYERS}', $this->getServer()->getMaxPlayers(), $motd);
                    $this->getServer()->getNetwork()->setName($motd);
        }
    }
    
    public function hunger(){
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->getPlayer()->setFood(15);
            if($this->default->get("use.regeneration.system") === true){
                $players->setHealth($players->getPlayer()->getHealth() + 1);
            }
        }
    }
    
    
}
    
    


