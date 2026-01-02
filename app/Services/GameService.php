<?php
namespace App\Services;

class GameService
{
    public const BET_AMOUNT = 10;

    public function rollDice(): array
    {
        $dice1 = rand(1, 6);
        $dice2 = rand(1, 6);

        return [
            'dice1' => $dice1,
            'dice2' => $dice2,
            'sum'   => $dice1 + $dice2,
        ];
    }

    public function calculateWin(string $bet, int $sum): int
    {
        return match ($bet) {
            'below_7' => $sum < 7 ? 20 : 0,
            'above_7' => $sum > 7 ? 20 : 0,
            'lucky_7' => $sum === 7 ? 30 : 0,
            default   => 0,
        };
    }

    public function isLowBalance(int $balance): bool
    {
        return $balance < 10;
    }
}
