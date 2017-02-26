<?php
/**
 * Created by Artdevue.
 * User: artdevue - MainTask.php
 * Date: 26.02.17
 * Time: 04:53
 * Project: phalcon-blank
 */

class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo "\nThis is the default task and the default action DEF \n";
    }

    /**
     * @param array $params
     */
    public function testAction(array $params)
    {
        echo sprintf('hello %s', $params[0]) . PHP_EOL;
        echo sprintf('best regards, %s', $params[1]) . PHP_EOL;
    }
}