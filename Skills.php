<?php

require_once "SkillInterface.php";

class Skills
{
    private array $attackingSkills = [];
    private array $defendingSkills = [];

    public function setAttackingSkills(array $attackingSkills): void
    {
        $this->attackingSkills = $attackingSkills;
    }

    public function setDefendingSkills(array $defendingSkills): void
    {
        $this->defendingSkills = $defendingSkills;
    }

    public function getAttackingSkill(): ?SkillInterface
    {
        foreach ($this->attackingSkills as $skill) {
            if ($skill->canActivateSkill()) {
                return $skill;
            }
        }

        return null;
    }

    public function getDefendingSkill(): ?SkillInterface
    {
        foreach ($this->defendingSkills as $skill) {
            if ($skill->canActivateSkill()) {
                return $skill;
            }
        }

        return null;
    }
}
