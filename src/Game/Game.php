<?php
namespace App\Game;

use App\Entity\Player;
use App\Entity\Bees\Bee;
use App\Service\Randomizer;
use App\Game\BeeFactory;
use App\Game\TurnManager;

class Game
{
    private Player $player;
    private array $bees = [];
    private TurnManager $turnManager;
    private Randomizer $randomizer;
    private bool $autoMode = false;

    public function __construct(
        bool $autoMode = false,
        ?Randomizer $randomizer = null,
        ?TurnManager $turnManager = null,
        ?BeeFactory $beeFactory = null
    ) {
        $this->autoMode = $autoMode;
        $this->player = new Player();
        $this->randomizer = $randomizer ?? new Randomizer();
        $factory = $beeFactory ?? new BeeFactory();
        $this->bees = $factory->createHive();
        $this->turnManager = $turnManager ?? new TurnManager(
            $this->player,
            $this->bees,
            $this->randomizer
        );
    }

    public function play(): void
    {
        while ($this->player->isAlive() && !$this->turnManager->hiveIsDead()) {
            if (!$this->autoMode) {
                echo "Type 'hit' to attack or 'auto' to simulate: ";
                $input = trim(fgets(STDIN));

                if ($input === 'auto') {
                    $this->autoMode = true;
                } elseif ($input !== 'hit') {
                    echo "Invalid input.\n";
                    continue;
                }
            }

            $this->turnManager->executeTurn();
            echo $this->turnManager->getLastTurnReport();
        }

        echo "\n-- Game Over --\n";
        echo $this->turnManager->getGameSummary();
    }
}
