<?php

namespace nasiridrishi\primeplaceholder\placeholder;

use pocketmine\player\Player;
use pocketmine\utils\Utils;

class ClosurePlaceHolder extends PlaceHolder {

    /**
     * @param string $identifier
     * @phpstan-param \Closure(Player, string) : string $closure
     */
    public function __construct(string $identifier, private \Closure $closure) {
        parent::__construct($identifier);
        Utils::validateCallableSignature(function(Player $player, string $string): string{}, $closure);
    }

    public function onRequest(Player $player, string $string): string {
        return ($this->closure)($player, $string);
    }
}