<?php


namespace Classes\Loggers;


class GameLogger
{
    protected static $gameLog;

    /**
     * @return string
     */
    public static function getGameLog(): string
    {
        return self::$gameLog;
    }

    /**
     * @param string $player
     * @param int $damage
     * @param string $unit
     */
    public static function setDamage(string $player, string $unit, int $damage): void
    {
        $string = "<p>$player $unit Нанес урон - $damage -> ";
        self::$gameLog .= $string;
    }

    /**
     * @param string $player
     * @param string $unit
     * @param int $health
     */
    public static function setHealth(string $player, string $unit, int $health, int $count): void
    {
        if ($health > 0) {
            $string = " $player $unit осталось жизней $health</p>";
        } else {
            $string = " $player $unit Убит, осталось юнитов ($count) </p>";
        }

        self::$gameLog .= $string;
    }

    /**
     * @param string $gameLog
     */
    public static function gameOver(string $player): void
    {
        self::$gameLog .= "<p>$player выиграл этот бой.</p>";
    }

    /**
     * @param string $gameLog
     */
    public static function setGameLog(string $gameLog): void
    {
        self::$gameLog .= $gameLog;
    }
}