# - MegaPlugins
Variables Plugins, is not normal plugins from PocketMine-MP, Genisys, ImagicalMine, ClearSky, others

| Plugins | Informational |
| ---- | ------ |
| SuperCmds | Added More Commands for you Server |


## - SuperCmds
| Commands | SubCommand | Command Functions | Permission | Aliases |
| -------- | -------- | ----------------| ----------- | ------- |
| /fly | <not found> | enable flyght in you server | fly.command | /flyght |
| /gmd | [1,2,3,4] | change you gamemode in server | gmd.command | /gmode | 
| /seffect | [effectID] [effectAmplifier] [effectDuration] | add to you player effect | effect.command | /seffecter | 
| /motd | [you motd] | set you server motd | motd.command | /smotd |
| /plugin | [enable or disable] | disable or enable plugins in you server console or player client | plugin.command | /splg |

### Features
- Enable or Disable Commands in commands.yml
- Change Lang in Config
- Set you server Motd
- Disable or Enable Plugins!

### Variables
| Variable | Info | Example | Config |
| ------- | ---- | ------ | ----- |
| {EFFECT} | SET EFFECT MESSAGE | Seted {EFFECT} to You | you_lang.yml |
| {AMP} | SET AMPLIFIER TO EFFECT | Seted {AMP} to You Effect | you_lang.yml |
| {SECONDS} | SET SECONDS TO EFFECT | Seted {SECONDS} to You Effect | you_lang.yml |
| {GM} | SET YOU GAMEMODE | Changed you Gamemode to {GM} | you_lang.yml |
| {ONPLAYERS} | SET ONLINE PLAYERS IN MOTD | Server is online: [{ONPLAYERS}] | config.yml |
| {MAXPLAYERS} | SET MAX PLAYERS IN MOTD | Server max online: [{MAXPLAYERS}] | config.yml |

### To-Do
- Events
- More Commands

### Last Update
- Viewer: [Commit](https://github.com/RedstoneAlmeida/MegaPlugins/commit/8b162d70cb29c9e0d4a899002ec728bfa18d2d5c)

### Configs - Code
#### Hunger System
```php
---
hunger: false
use.regenation.system: true
...
```

```php
if($this->default->get("hunger") === false){
            $this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "hunger")), 10);
            $this->getLogger()->info(" ");
            $this->getLogger()->info("§aHunger Enabled...");
        }

public function hunger(){
        foreach($this->getServer()->getOnlinePlayers() as $players) {
            $players->getPlayer()->setFood(15);
            if($this->default->get("use.regenation.system") === true){
                $players->setHealth($players->getPlayer()->getHealth() + 1);
            }
        }
    }
```
