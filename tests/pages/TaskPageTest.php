<?php namespace test\pages;

use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;
use PHPUnit_Extensions_Selenium2TestCase_Keys as Keys;

class TestPageTest extends Selenium2TestCase {
    protected $site = 'http://therapy-box.loc/';
    protected $page = 'tasks';

    protected function setUp()
    {
        parent::setUp();

        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl($this->site);
        $this->setBrowser('chrome');
    }

    public function testTitle()
    {
        $this->url($this->page);
        $this->assertEquals('Tasks', $this->title());
    }

    public function testChangeDescription() {
        $this->url($this->page);

        $description = $this->byCssSelector('[name="description[1]"]');
        $description->clear();
        $description->value('Task #');

        $this->keys(Keys::ENTER);
        $this->refresh();

        $this->assertEquals('Task #', $this->byCssSelector('[name="description[1]"]')->value());
    }

    public function testAddNewPosition() {
        $this->url($this->page);

        $tasks = $this->elements($this->using('css selector')->value('.tasks__input'));
        $count = count($tasks);

        $form = $this->byCssSelector('form');
        $form->submit();

        $tasks = $this->elements($this->using('css selector')->value('.tasks__input'));
        $count2 = count($tasks);

        $this->assertNotEquals($count, $count2);
    }

    public function tearDown()
    {
        $this->stop();
    }
}