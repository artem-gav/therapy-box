<?php namespace tests\App\Services;

use PHPUnit\Framework\TestCase;
use App\Services\{FootballCsvFactory, FootballCsvFactoryException};
use org\bovigo\vfs\vfsStream;

class FootballCsvFactoryTest extends TestCase {
    private $footballCsvFactory;

    public function setUp() {
        $structure = [
            'csv' => [
                'input.csv' => "Div,Date,HomeTeam,AwayTeam,FTHG,FTAG,FTR,HTHG,HTAG,HST,AST\nI1,19/08/17,Juventus,Cagliari,3,0,H,2,0,3,0\nI1,26/08/17,Genoa,Juventus,2,4,A,2,2,2,0\nI1,09/09/17,Juventus,Chievo,3,0,H,1,0,1,4"
            ]
        ];

        $rootFolder = vfsStream::setup('root',null,$structure);
        $this->footballCsvFactory = new FootballCsvFactory($rootFolder->url() . '/csv/input.csv');
    }

    public function testIncorrectCsvPath() {
        $this->expectException(FootballCsvFactoryException::class);

        new FootballCsvFactory('/csv/no_exist_file.csv');
    }

    public function testListOfLosers() {
        $list_of_losers = $this->footballCsvFactory->listOfLosers('Juventus');

        $this->assertEquals($list_of_losers, ['Cagliari', 'Genoa', 'Chievo']);
        $this->assertNotEquals($list_of_losers, ['Cagliari', 'Genoa']);
    }

    public function testBiggestShotsOnTarget() {
        $biggestShotsOnTarget = $this->footballCsvFactory->biggestShotsOnTarget();

        $this->assertEquals($biggestShotsOnTarget['command'], 'Chievo');
        $this->assertEquals($biggestShotsOnTarget['shots'], 4);
    }
}