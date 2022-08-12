<?php
namespace Classes\Units;

require_once 'Classes/Units/Unit.php';

class Paladin extends Unit
{
    protected int $count;
    protected int $constantHealth = 150;
    protected int $health = 150;
    protected string $name = 'Paladin';
    protected int $damageMin = 20;
    protected int $damageMax = 25;
    protected $strength = 30;
    protected int $damage;
}