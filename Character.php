<?php

require_once "CharacterStatuses.php";
require_once "Skills.php";

class Character
{
	private CharacterStatuses $characterStatuses;
	private Skills $skills;

	public function __construct(CharacterStatuses $characterStatuses, Skills $skills)
	{
		$this->characterStatuses = $characterStatuses;
		$this->skills = $skills;
	}

	public function strikes(Character $enemy): array
	{
		$logs = [];

		$enemyCharacterStatuses = $enemy->getCharacterStatuses();

		if ($this->isLucky($enemyCharacterStatuses)) {
			$logs[] = $enemy::NAME.' got lucky and '.$this::NAME.' missed his attack.';

			return $logs;
		}

		$damageDealt = $this->calculateDamageDealt($enemyCharacterStatuses);

		$attackerSkill = $this->skills->getAttackingSkill();
		$defenderSkill = $enemy->getSkills()->getDefendingSkill();

		if (null !== $attackerSkill) {
			$logs[] = $this::NAME.' used skill '.$attackerSkill::NAME.'.';

			$attackerSkill->useSkill($this, $enemy, $damageDealt);
		}

		if (null !== $defenderSkill) {
			$logs[] = $enemy::NAME.' used skill '.$defenderSkill::NAME.'.';

			$defenderSkill->useSkill($enemy, $this, $damageDealt);
		}

		$enemyCharacterStatuses->damageHealth($damageDealt);

		$logs[] = $this::NAME.' striked '.$enemy::NAME.' for '.$damageDealt.' damage.';

		return $logs;
	}

	public function getCharacterStatuses(): CharacterStatuses
	{
		return $this->characterStatuses;
	}

	public function getSkills(): Skills
	{
		return $this->skills;
	}

	public function isDead(): bool
	{
		return $this->characterStatuses->getHealth() <= 0;
	}

	private function calculateDamageDealt(CharacterStatuses $enemyCharacterStatuses): int
	{
		$damageDealt = $this->characterStatuses->getStrength() - $enemyCharacterStatuses->getDefence();

		if ($damageDealt <= 0) {
			return 0;
		} 

		return $damageDealt;
	}

	private function isLucky(CharacterStatuses $enemyCharacterStatuses): bool
	{
		return random_int(1, 100) <= $enemyCharacterStatuses->getLuck();
	}
}
