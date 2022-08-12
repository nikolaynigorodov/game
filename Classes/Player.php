<?php
namespace Classes;

require_once 'Classes/Units/Warlock.php';
require_once 'Classes/Units/Magician.php';
require_once 'Classes/Units/Paladin.php';
require_once 'Classes/Loggers/GameLogger.php';
require_once 'Classes/RandomOrg.php';

use Classes\Units\Warlock;
use Classes\Units\Magician;
use Classes\Units\Paladin;
use LogicException;

use Classes\Loggers\GameLogger;

class Player
{
    protected $army = [];
    protected $units;
    protected $name = 'Player';

    public function __construct($army, $name)
    {
        $this->army = $army;
        $this->name = $name;
        $this->createArmy();
    }

    public function createArmy()
    {
        foreach ($this->army as $className => $count) {
            if($count > 0) {
                $class = 'Classes\Units\\' . $className;
                if (!class_exists($class, false)) {
                    throw new LogicException("Unable to load class: $class");
                }
                $this->setUnits(new $class($count, new GameLogger(), new RandomOrg()));
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUnits()
    {
        $this->sortingUnitByStrength();

        foreach ($this->units as $unit) {
            if($unit->getCount() > 0 && $unit->getHealth() > 0) {
                return $unit;
            }
        }

        return false;
    }

    /**
     * @param mixed $units
     */
    public function setUnits($units)
    {
        $this->units[] = $units;
    }

    protected function sortingUnitByStrength()
    {
        uasort($this->units, function ($a, $b) {
            if ($a->getStrength() == $b->getStrength()) return 0;
            return ($a->getStrength() < $b->getStrength()) ? -1 : 1;
        });
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}