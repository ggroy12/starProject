<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;
use Model\BattleResult;

class BattleManager
{
    public const TYPE_NORMAL = 'normal';
    public const TYPE_NO_JEDI = 'no_jedi';
    public const TYPE_ONLY_JEDI = 'only_jedi';

    public function battle(
        AbstractShip $ship1,
        int $ship1Quantity,
        AbstractShip $ship2,
        int $ship2Quantity,
        string $battleType
    ): BattleResult {
        $ship1Health = $ship1->getStrength() * $ship1Quantity;
        $ship2Health = $ship2->getStrength() * $ship2Quantity;

        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;
        $battleLimit = 0;
        while ($ship1Health > 0 && $ship2Health > 0) {
            if ($battleType !== self::TYPE_NO_JEDI && $this->isJediDestroyShipUsingTheForce($ship1)) {
                $ship2Health = 0;
                $ship1UsedJediPowers = true;

                break;
            }
            if ($battleType !== self::TYPE_NO_JEDI && $this->isJediDestroyShipUsingTheForce($ship2)) {
                $ship1Health = 0;
                $ship2UsedJediPowers = true;

                break;
            }

            if ($battleType !== self::TYPE_ONLY_JEDI) {
                $ship1Health -= ($ship2->getWeaponPower() * $ship2Quantity);
                $ship2Health -= ($ship1->getWeaponPower() * $ship1Quantity);
            }

            if ($battleLimit > 100) {
                $ship1Health = 0;
                $ship2Health = 0;
            }
            $battleLimit++;
        }

        if ($ship1Health <= 0 && $ship2Health <= 0) {
            $winningShip = null;
            $losingShip = null;
            $usedJediPowers = $ship1UsedJediPowers || $ship2UsedJediPowers;
        } elseif ($ship1Health <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
        }

        $ship1->setStrength($ship1Health);
        $ship2->setStrength($ship2Health);

        return new BattleResult(
            $winningShip,
            $losingShip,
            $usedJediPowers
        );
    }

    public static function getTypes(): array
    {
        return [
            self::TYPE_NORMAL => 'Нормальный',
            self::TYPE_NO_JEDI => 'Без джедая',
            self::TYPE_ONLY_JEDI => 'Только джедай',

        ];
    }

    private function isJediDestroyShipUsingTheForce(AbstractShip $ship): bool
    {
        return mt_rand(1, 100) <= $ship->getJediFactor();
    }
}