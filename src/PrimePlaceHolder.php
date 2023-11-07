<?php

namespace nasiridrishi\primeplaceholder;

use nasiridrishi\primeplaceholder\placeholder\ClosurePlaceHolder;
use nasiridrishi\primeplaceholder\placeholder\PlaceHolder;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class PrimePlaceHolder extends PluginBase{

    private static PrimePlaceHolder $instance;

    /**
     * @var PlaceHolder[]
     */
    private array $placeholders = [];

    /**
     * @return PrimePlaceHolder
     */
    public static function getInstance(): PrimePlaceHolder {
        return self::$instance;
    }

    protected function onLoad(): void {
        self::$instance = $this;
    }

    protected function onEnable(): void {
        $this->registerCommons();
    }

    public function registerPlaceHolder(PlaceHolder $placeHolder): void {
        $this->placeholders[$placeHolder->getIdentifier()] = $placeHolder;
    }

    public function setPlaceHolders(array|string $text, Player $player): array|string {
        if(is_array($text)){
            foreach($text as $key => $value){
                $text[$key] = $this->setPlaceHolders($value, $player);
            }
        }else{
//            preg_match_all("/%([a-zA-Z0-9]+)%/", $text, $matches);
//            foreach($matches[1] as $match) {
//                if(isset($this->placeholders[$match])) {
//                    $text = str_replace("%" . $match . "%", $this->placeholders[$match]->onRequest($player, $text), $text);
//                }
//            }
            //check for placeholder for arugments formated as %identifier_<argument>% or %identifier%
            preg_match_all("/%([a-zA-Z0-9]+)(?:_([a-zA-Z0-9]+))?%/", $text, $matches);
            foreach($matches[1] as $key => $match) {
                if(isset($this->placeholders[$match])) {
                    $text = str_replace("%" . $matches[0][$key] . "%", $this->placeholders[$match]->onRequest($player, $matches[0][$key]), $text);
                }
            }
        }

        return $text;
    }



    private function registerCommons(): void{
        $this->registerPlaceHolder(new ClosurePlaceHolder("player", function (Player $player, string $string): string {
            return $player->getName();
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("displayname", function (Player $player, string $string): string {
            return $player->getDisplayName();
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("ping", function (Player $player, string $string): string {
            return ($ping = $player->getNetworkSession()->getPing()) !== null ? (string)$ping : "0";
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("gamemode", function (Player $player, string $string): string {
            return $player->getGameMode()->getEnglishName();
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("health", function (Player $player, string $string): string {
            return (string)$player->getHealth();
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("maxhealth", function (Player $player, string $string): string {
            return (string)$player->getMaxHealth();
        }));
        //world placeholders
        $this->registerPlaceHolder(new ClosurePlaceHolder("world", function (Player $player, string $string): string {
            return $player->getWorld()->getFolderName();
        }));
        $this->registerPlaceHolder(new ClosurePlaceHolder("worldtime", function (Player $player, string $string): string {
            return (string)$player->getWorld()->getTime();
        }));
        //pos_x
        $this->registerPlaceHolder(new ClosurePlaceHolder("pos_x", function (Player $player, string $string): string {
            return (string)$player->getPosition()->getFloorX();
        }));
        //pos_y
        $this->registerPlaceHolder(new ClosurePlaceHolder("pos_y", function (Player $player, string $string): string {
            return (string)$player->getPosition()->getFloorY();
        }));
        //pos_z
        $this->registerPlaceHolder(new ClosurePlaceHolder("pos_z", function (Player $player, string $string): string {
            return (string)$player->getPosition()->getFloorZ();
        }));
        //online players
        $this->registerPlaceHolder(new ClosurePlaceHolder("online_players", function (Player $player, string $string): string {
            return (string)count($player->getServer()->getOnlinePlayers());
        }));
        //max players
        $this->registerPlaceHolder(new ClosurePlaceHolder("max_players", function (Player $player, string $string): string {
            return (string)$player->getServer()->getMaxPlayers();
        }));
    }

}