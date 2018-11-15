<?php
declare(strict_types=1);

namespace TildBJ\Seeder\Tests\Functional\Command;

use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Class SeederCommandControllerTest
 */
class SeederCommandControllerTest extends UnitTestCase
{
    protected $subject;

    public function setUp()
    {
        $this->subject = new \TildBJ\Seeder\Command\SeederCommandController();
        $output = $this->createMock(\TildBJ\Seeder\Utility\OutputUtility::class);
        $this->inject($this->subject, 'outputUtility', $output);
        $GLOBALS['TCA']['pages']['columns']['title'] = unserialize('a:2:{s:5:"label";s:36:"LLL:EXT:lang/locallang_tca.xlf:title";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"50";s:3:"max";s:3:"255";s:4:"eval";s:13:"trim,required";}}');
    }

    /**
     * @test
     */
    public function seedCommandThrowsExceptionIfTableConfigurationDoesNotExist()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->subject->seedCommand('SeedWhichNotExist');
    }

    /**
     * @test
     */
    public function makeCommandThrowsExceptionIfTableConfigurationDoesNotExist()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->subject->makeCommand('A', 'abc');
    }

    /**
     * @test
     */
    public function makeCommandThrowsExceptionIfClassAlreadyExist()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->subject->makeCommand('Image', 'pages');
    }

    /**
     * @test
     */
    public function makeCommandCreatesNewClass()
    {
        $file = realpath(dirname(__FILE__) . '/../../../Classes/Seeder/') . '/Test.php';
        $this->subject->makeCommand('Test', 'pages');
        $this->assertTrue(file_exists($file));
    }

    public function tearDown()
    {
        parent::tearDown();
        $file = realpath(dirname(__FILE__) . '/../../../Classes/Seeder/') . '/Test.php';
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
