<?php

class Battle
{
    private array $fightLogs = [];

    public function getFightLogs(): array
    {
        return $this->fightLogs;
    }

	public function fight(Character $player1, Character $player2): void
	{
        $this->clearFightLogs();
        
        [$player1, $player2] = $this->computeAttackingOrder($player1, $player2);

        $this->fightRounds($player1, $player2);
    }

    private function fightRounds(Character $player1, Character $player2, int $maxRounds = 20, int $currentRound = 1): void
    {
        if ($currentRound >= $maxRounds) {
            $this->fightLogs[$currentRound][] = 'Draw!';

            return;
        }
        $this->fightLogs[$currentRound][] = $player1::NAME . ' health is ' . $player1->getCharacterStatuses()->getHealth();
        $this->fightLogs[$currentRound][] = $player2::NAME . ' health is ' . $player2->getCharacterStatuses()->getHealth();
        $logs = $player1->strikes($player2);

        foreach ($logs as $log) {
            $this->fightLogs[$currentRound][] = $log;
        }

        if ($player2->isDead()) {
            $this->fightLogs[$currentRound][] = $player2::NAME.' died!';
            $this->fightLogs[$currentRound][] = $player1::NAME.' won the fight!';

            return;
        }

        $logs = $player2->strikes($player1);

        foreach ($logs as $log) {
            $this->fightLogs[$currentRound][] = $log;
        }

        if ($player1->isDead()) {
            $this->fightLogs[$currentRound][] = $player1::NAME.' died!';
            $this->fightLogs[$currentRound][] = $player2::NAME.' won the fight!';

            return;
        }

        $currentRound++;

        $this->fightRounds($player1, $player2, $maxRounds, $currentRound);
    }

    private function computeAttackingOrder(Character $player1, Character $player2): array
    {
        $player1CharacterStatuses = $player1->getCharacterStatuses();
        $player2CharacterStatuses = $player2->getCharacterStatuses();

        if ($player1CharacterStatuses->getSpeed() < $player2CharacterStatuses->getSpeed()) {
            return [$player2, $player1];
        }

        if ($player1CharacterStatuses->getSpeed() > $player2CharacterStatuses->getSpeed()) {
            return [$player1, $player2];
        }

        if ($player1CharacterStatuses->getLuck() < $player2CharacterStatuses->getLuck()) {
            return [$player2, $player1];
        }

        if ($player1CharacterStatuses->getLuck() > $player2CharacterStatuses->getLuck()) {
            return [$player1, $player2];
        }

        return [$player1, $player2];
    }

    private function clearFightLogs(): void
    {
        $this->fightLogs = [];
    }
}
