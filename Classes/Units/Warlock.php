<?php
namespace Classes\Units;

require_once 'Classes/Units/Unit.php';

class Warlock extends Unit
{
    protected int $count;
    protected int $constantHealth = 50;
    protected int $health = 50;
    protected string $name = 'Warlock';
    protected int $damageMin = 0;
    protected int $damageMax = 10;
    protected $strength = 10;
    protected int $damage;

}