# Bees In The Trap

A PHP command-line game where you must destroy a hive of bees before they sting you to death.

## Requirements
- PHP 8.0 or higher
- Composer

## Installation
```bash
composer install
chmod +x bin/beesinthetrap
```

## How to Play
```bash
./bin/beesinthetrap
```

Type `hit` to take your turn, or `auto` to simulate until the end.

## Testing
```bash
composer test
```

## Project Structure
```
src/
  Game/       → Main game engine, BeeFactory, TurnManager
  Entity/     → Player and Bee types
  Service/    → Randomizer abstraction
tests/        → PHPUnit test coverage
bin/          → Executable entry point
vendor/       → Composer dependencies
```

## Notes
-Modular architecture with separation of concerns
-The game uses dependency injection for testability
-Core logic is fully unit-tested
-Constants are used for all game balance values
-Fully compatible with PHPUnit 10
-Includes integration tests for game scenarios