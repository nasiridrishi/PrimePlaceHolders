# PrimePlaceHolders
A placeholder plugin for [PocketMine](https://i.imgur.com/qpnk5BX.png)

---
## Available Placeholders:
- `%player%` - Player Name
- `%displayname%` - Player Display Name
- `%ping%` - Player Ping
- `%gamemode%` - Player Gamemode
- `%health%` - Player Health
- `%maxhealth%` - Player Max Health
- `%world%` - Player World Name
- `%worldtime%` - Player World Time
- `%pos_x%` - Player X Position
- `%pos_y%` - Player Y Position
- `%pos_z%` - Player Z Position
- `%online_players%` - Online Players
- `%max_players%` - Max Players
---

### TODO:
- [x] Add more placeholders
- [ ] Add API for developers
- [ ] Add addon system which can load php class directly from plugins data folder

---

### API:

- **Register new placeholder**
```php
PrimePlaceHolder::getInstance()
  ->registerPlaceholder(new class extends PrimePlaceHolder{});
```
or
```php
PrimePlaceHolder::getInstance()->registerPlaceholder(new ClosurePlaceHolder("identifier", function (Player $player, string $string): string {})));
```

- **Set placeholders**
```php
PrimePlaceHolder::getInstance()->setPlaceholders($player, $string);
```

---

### [Help/Report Bugs(Discord)](https://discord.gg/eqxV2HEkhh)