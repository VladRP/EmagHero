<?php

require_once "CharacterStatuses.php";
require_once "Character.php";
require_once "Skills.php";

class WildBeast extends Character
{
    public const NAME = 'Wild Beast';

    public function __construct()
    {
        $statuses = [
            CharacterStatuses::HEALTH => [
                CharacterStatuses::MIN => 60,
                CharacterStatuses::MAX => 90,
            ],
            CharacterStatuses::STRENGTH => [
                CharacterStatuses::MIN => 60,
                CharacterStatuses::MAX => 90,
            ],
            CharacterStatuses::DEFENCE => [
                CharacterStatuses::MIN => 40,
                CharacterStatuses::MAX => 60,
            ],
            CharacterStatuses::SPEED => [
                CharacterStatuses::MIN => 40,
                CharacterStatuses::MAX => 60,
            ],
            CharacterStatuses::LUCK => [
                CharacterStatuses::MIN => 25,
                CharacterStatuses::MAX => 40,
            ],
        ];

        $characterStatuses = new CharacterStatuses($statuses);

        $skills = new Skills();

        parent::__construct($characterStatuses, $skills);
    }
}
