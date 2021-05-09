<?php

require_once "CharacterStatuses.php";
require_once "Character.php";
require_once "Skills.php";
require_once "RapidStrike.php";
require_once "MagicShield.php";

class Orderus extends Character
{
    public const NAME = 'Orderus';

    public function __construct()
    {
        $statuses = [
            CharacterStatuses::HEALTH => [
                CharacterStatuses::MIN => 70,
                CharacterStatuses::MAX => 100,
            ],
            CharacterStatuses::STRENGTH => [
                CharacterStatuses::MIN => 70,
                CharacterStatuses::MAX => 80,
            ],
            CharacterStatuses::DEFENCE => [
                CharacterStatuses::MIN => 45,
                CharacterStatuses::MAX => 55,
            ],
            CharacterStatuses::SPEED => [
                CharacterStatuses::MIN => 40,
                CharacterStatuses::MAX => 50,
            ],
            CharacterStatuses::LUCK => [
                CharacterStatuses::MIN => 10,
                CharacterStatuses::MAX => 30,
            ],
		];

        $characterStatuses = new CharacterStatuses($statuses);

        $skills = new Skills();
        $skills->setAttackingSkills([new RapidStrike(10)]);
        $skills->setDefendingSkills([new MagicShield(20)]);

        parent::__construct($characterStatuses, $skills);
	}
}
