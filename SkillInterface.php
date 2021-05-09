<?php

interface SkillInterface
{
    public function canActivateSkill(): bool;

	public function useSkill(Character $attackingCharacter, Character $defendingCharacter, float &$damageToDefender): void;
}
