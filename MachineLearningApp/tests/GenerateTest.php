<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenerateTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }

    public function testOpenGenerate()
    {
        $this->visit('generator')
             ->seePageIs('generator')
             ->see('Generate dataset');
    }

    public function testGenerateRecords()
    {
        $this->visit('generator')
             ->seePageIs('generator')
             ->seeElement('body > div.container > div > div:nth-child(1) > form > button')
             ->see('Generate')
             ->type(25 , 'rows');
//             ->click('btn btn-info xh-highlight');
//             ->check('Generate');
//             ->see('Records number: 25');
    }
}
