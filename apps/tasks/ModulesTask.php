<?php
/**
 * Created by Artdevue.
 * User: artdevue - ModulesTask.php
 * Date: 28.02.17
 * Time: 00:54
 * Project: phalcon-blank
 */

class ModulesTask extends \Phalcon\Cli\Task
{
    /**
     * Creating or deleting modules based on configuration file
     *
     * Run comand in the console:
     * $ php apps/cli.php modules update
     */
    public function updateAction()
    {
        $modules = $this->config->modules;

        $dir    = PROJECT_PATH . 'apps';
        $dir_array = scandir($dir);
        foreach ($modules as $key => $module) {
            if (!isset($dir_array[$key])) {

                echo "Do you really want to install the module " . $key . "?  Type 'yes' to continue: ";
                $handle = fopen ("php://stdin","r");
                $line = fgets($handle);
                if(trim($line) != 'yes'){
                    echo "ABORTING!\n";
                } else {
                    echo "\n";
                    echo "Thank you, continuing...\n";
                }
            }
        }
    }
}