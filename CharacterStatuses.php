<?php

class CharacterStatuses
{
	public const HEALTH = 'health';
	public const STRENGTH = 'strength';
	public const DEFENCE = 'defence';
	public const SPEED = 'speed';
	public const LUCK = 'luck';

	public const MIN = 'min';
	public const MAX = 'max';

	private int $minHealth;
	private int $maxHealth;
	private int $minStrength;
	private int $maxStrength;
	private int $minDefence;
	private int $maxDefence;
	private int $minSpeed;
	private int $maxSpeed;
	private int $minLuck;
	private int $maxLuck;

	private int $health;
	private int $strength;
	private int $defence;
	private int $speed;
	private int $luck;

	public function __construct(array $statuses)
	{
		$this->minHealth = $statuses[self::HEALTH][self::MIN];
		$this->maxHealth = $statuses[self::HEALTH][self::MAX];
		$this->minStrength = $statuses[self::STRENGTH][self::MIN];
		$this->maxStrength = $statuses[self::STRENGTH][self::MAX];
		$this->minDefence = $statuses[self::DEFENCE][self::MIN];
		$this->maxDefence = $statuses[self::DEFENCE][self::MAX];
		$this->minSpeed = $statuses[self::SPEED][self::MIN];
		$this->maxSpeed = $statuses[self::SPEED][self::MAX];
		$this->minLuck = $statuses[self::LUCK][self::MIN];
		$this->maxLuck = $statuses[self::LUCK][self::MAX];

		$this->randomizeStatuses();
	}

	private function randomizeStatuses(): void
	{
		$this->health = self::getRandomStaus($this->minHealth, $this->maxHealth);
		$this->strength = self::getRandomStaus($this->minStrength, $this->maxStrength);
		$this->defence = self::getRandomStaus($this->minDefence, $this->maxDefence);
		$this->speed = self::getRandomStaus($this->minSpeed, $this->maxSpeed);
		$this->luck = self::getRandomStaus($this->minLuck, $this->maxLuck);
	}

	private function getRandomStaus(int $min, int $max): int 
	{
		return random_int($min, $max);
	}

	public function getHealth(): int
	{
		return $this->health;
	}

	public function damageHealth(int $damage): void
	{
		$health = $this->health;
		$currentHealth = $health - $damage;

		if ($currentHealth < 0) {
			$this->health = 0;
		}

		$this->health = $currentHealth;
	}

	public function getStrength(): int
	{
		return $this->strength;
	}

	public function getDefence(): int
	{
		return $this->defence;
	}

	public function getSpeed(): int
	{
		return $this->speed;
	}

	public function getLuck(): int
	{
		return $this->luck;
	}
}
