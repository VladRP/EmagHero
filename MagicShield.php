<?php

require_once "SkillInterface.php";
require_once "Character.php";

class MagicShield implements SkillInterface
{
    public const NAME = 'Magic Shield';

    private int $chanceToActivate;

    public function __construct(int $chanceToActivate)
    {
        $this->chanceToActivate = $chanceToActivate;
    }

    public function canActivateSkill(): bool
    {
        return random_int(1, 100) <= $this->chanceToActivate;
    }

	public function useSkill(Character $attackingCharacter, Character $defendingCharacter, float &$damageToDefender): void
	{
        $damageToDefender /= 2;
	}
}
