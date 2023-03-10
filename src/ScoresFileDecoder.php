<?php

declare(strict_types=1);

namespace App;

use Exception;

class ScoresFileDecoder
{
    private array $scores = [];
    private array $columnsData = [];

    public function __construct(private string $filename)
    {
    }

    public function getFormattedDecodedScores(): string
    {
        try {
            $decodedScores = $this->sortScoresInDescendingOrder($this->getDecodedScores());
            $formattedScores = '';

            foreach ($decodedScores as $player => $score) {
                $formattedScores .= "$player, $score<br>";
            }

            return $formattedScores;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /** @throws Exception */
    private function decodeScores(): void
    {
        if (!file_exists($this->filename)) {
            throw new Exception('Filename does not exist');
        }

        $file = $this->openFile();
        $this->processFile($file);
        $this->closeFile($file);
    }

    /** @return array result [player (string) => score (int)] */
    private function getDecodedScores(): array
    {
        $this->decodeScores();

        return $this->scores;
    }

    /** @return false|resource */
    private function openFile()
    {
        return fopen($this->filename, "r");
    }

    /** @param false|resource */
    private function closeFile($file): void
    {
        fclose($file);
    }

    /** @param false|resource $file */
    private function processFile($file): void
    {
        while (($data = fgetcsv($file)) !== false) {
            $this->columnsData = $data;
            $playerName = $this->getDataOfColumnIndex(0);
            $encodingDigits = $this->getDataOfColumnIndex(1);
            $codedScore = $this->getDataOfColumnIndex(2);

            $decodedScore = $this->decodeScore($encodingDigits, $codedScore);
            $this->setPlayerScore($decodedScore, $playerName);
        }
    }

    private function decodeScore(string $encodingDigits, string $codedScore): int
    {
        $encoding_digits = str_split($encodingDigits);
        $coded_score = str_split($codedScore);
        $score = 0;
        $base = count($encoding_digits);

        for ($i = 0; $i < count($coded_score); $i++) {
            $encodingDigit = array_search($coded_score[$i], $encoding_digits);
            $power = count($coded_score) - $i - 1;
            $score += $encodingDigit * pow($base, $power);
        }

        return intval($score);
    }

    private function setPlayerScore(int $score, string $player): void
    {
        $this->scores[$player] = $score;
    }

    public function sortScoresInDescendingOrder(array $scores): array
    {
        arsort($scores);

        return $scores;
    }

    private function getDataOfColumnIndex(int $index): string
    {
        return trim($this->columnsData[$index]);
    }
}