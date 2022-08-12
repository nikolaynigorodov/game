<?php
namespace Classes\Units;

use Classes\Loggers\GameLogger;
use Classes\RandomOrg;

require_once 'Classes\Loggers\GameLogger.php';

class Unit
{
    protected int $count = 0;
    protected int $health = 0;
    protected int $constantHealth = 0;
    protected string $name = 'Unit Name';
    protected int $damageMin = 0;
    protected int $damageMax = 0;
    protected $strength = 0;
    protected int $damage;

    protected GameLogger $gameLogger;
    protected RandomOrg $randomOrgApi;

    public function __construct($count, GameLogger $gameLogger, RandomOrg $randomOrg)
    {
        $this->count = $count;
        $this->gameLogger = $gameLogger;
        $this->randomOrgApi = $randomOrg;
    }

    /**
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @param string $playerName
     */
    public function setHealthCount($health, $playerName)
    {
        $this->health = $this->health - $health;
        if ($this->health <= 0) {
            $this->health = 0;
            $this->setCount($this->count - 1);
        }
        $this->gameLogger::setHealth($playerName, $this->name, $this->health, $this->count);
        $this->balanceHealthByCount();

    }

    public function balanceHealthByCount()
    {
        if($this->health <= 0) {
            if($this->count > 0) {
                $this->health = $this->constantHealth;
            }
        }
    }

    /**
     * @param string $playerName
     * @return mixed
     */
    public function getDamage($playerName)
    {
        //$this->damage = rand(0, 25);
        $this->damage = $this->randomOrgApi
            ->setMin($this->damageMin)
            ->setMax($this->damageMax)
            ->requestApi()
            ->getRandomValue();
        $this->gameLogger::setDamage($playerName, $this->name, $this->damage);
        return $this->damage;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int$count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }
}