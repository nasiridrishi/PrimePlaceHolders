<?php

namespace nasiridrishi\primeplaceholder\placeholder;

use pocketmine\player\Player;

abstract class PlaceHolder {

    /**
     * @param string $identifier
     */
    public function __construct(private string $identifier) {
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public abstract function onRequest(Player $player, string $string): string;
}