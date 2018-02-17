<?php namespace App\Services;

use League\Csv\Reader;

class FootballCsvFactory {
    protected $csv_path;
    protected $records;

    function __construct($csv_path) {
        $this->csv_path = $csv_path;

        $csv = Reader::createFromPath($this->csv_path, 'r');
        $csv->setHeaderOffset(0);
        $this->records = $csv->getRecords();
    }

    public function biggestShotsOnTarget() {
        $shots_home_team = [];
        $shots_away_team = [];
        foreach ($this->records as $record) {
            $shots_home_team[] = $record['HST'];
            $shots_away_team[] = $record['AST'];
        }

        $max_shot_home_team = max($shots_home_team);
        $max_shot_away_team = max($shots_away_team);

        if($max_shot_home_team > $max_shot_away_team) {
            $team = 'HomeTeam';
            $shots = $max_shot_home_team;
        } else {
            $team = 'AwayTeam';
            $shots = $max_shot_away_team;
        }

        $table_accordance = [
            'HomeTeam' => 'HST',
            'AwayTeam' => 'AST',
        ];

        $command = '';
        foreach ($this->records as $record) {
            if($record[$table_accordance[$team]] === $shots) {
                $command = $record[$team];
            }
        }

        return [
            'command' => $command,
            'shots' => $shots
        ];
    }

    public function listOfLosers($command) {
        $list = [];
        foreach ($this->records as $record) {
            if(strpos($record['HomeTeam'], $command) !== false && $record['FTHG'] > $record['FTAG']) {
                $list[] = $record['AwayTeam'];
            }

            if(strpos($record['AwayTeam'], $command) !== false && $record['FTAG'] > $record['FTHG']) {
                $list[] = $record['HomeTeam'];
            }
        }

        return $list;
    }
}