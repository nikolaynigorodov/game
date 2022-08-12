<?php


namespace Classes;

require_once 'Classes\Loggers\GameLogger.php';

use Classes\Loggers\GameLogger;
use Classes\Units\Unit;

class Battle
{
    protected object $player1;
    protected object $player2;

    /**
     * @var Unit $unitPlayer_1
     */
    protected $unitPlayer_1;

    /**
     * @var Unit $unitPlayer_2
     */
    protected $unitPlayer_2;

    /**
     * Battle constructor.
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function fight()
    {
        for ($i = 1; $i < 1000000; $i++) {
            if($this->checkUpdateUnit()) {
                $this->unitPlayer_2->setHealthCount(
                    $this->unitPlayer_1->getDamage($this->player1->getName()), $this->player2->getName()
                );
                if($this->checkUpdateUnit()) {
                    $this->unitPlayer_1->setHealthCount(
                        $this->unitPlayer_2->getDamage($this->player2->getName()), $this->player1->getName()
                    );
                } else {
                    break;
                }
            } else {
                break;
            }
        }
        return GameLogger::class;
    }

    protected function getUnits(Player $player)
    {
        return $player->getUnits();
    }

    protected function checkUpdateUnit()
    {
        $this->unitPlayer_1 = $this->getUnits($this->player1);
        $this->unitPlayer_2 = $this->getUnits($this->player2);

        if(!$this->unitPlayer_1) {
            GameLogger::gameOver($this->player2->getName());
            return false;
        } elseif (!$this->unitPlayer_2) {
            GameLogger::gameOver($this->player1->getName());
            return false;
        } else {
            return true;
        }
    }
}