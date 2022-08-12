<?php
namespace Classes\Units;

require_once 'Classes/Units/Unit.php';

class Magician extends Unit
{
    protected int $count;
    protected int $constantHealth = 150;
    protected int $health = 150;
    protected string $name = 'Magician';
    protected int $damageMin = 10;
    protected int $damageMax = 20;
    protected $strength = 20;
    protected int $damage;
}