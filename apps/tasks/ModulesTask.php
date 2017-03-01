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
     * @var string
     */
    public $name_module;

    /**
     * @var string
     */
    public $name_namespace;

    /**
     * Creating or deleting modules based on configuration file
     *
     * Run comand in the console:
     * $ php apps/cli.php modules update
     */
    /*public function updateAction()
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
                    //open file and get data
                    $data = file_get_contents(PROJECT_PATH . "config/config.php");

                }
            }
        }
    }*/

    public function createAction(array $params)
    {
        if (!isset($params[0])) {
            echo 'Installation this module is an error! The module name is required.';
            echo PHP_EOL;
            die();
        }

        $this->name_module    = strtolower($params[0]);
        $this->name_namespace = ucfirst($this->name_module);

        echo sprintf(
            "Do you really want to install the module %s?  Type 'yes' to continue: ",
            $this->name_module
        );
        $handle = fopen("php://stdin", "r");
        $line   = fgets($handle);
        if (trim($line) != 'yes') {
            echo "ABORTING!";
            echo PHP_EOL;
            die();
        } else {
            echo PHP_EOL;
            echo "Thank you, continuing...";
            echo PHP_EOL;

            // Check for the existence of a module
            $modules   = $this->config->modules;
            $this_name_module = $this->name_module;

            if (!empty($this->config->$this_name_module)) {
                echo "Recording module " . $this->name_module . " already exists in the configuration file.";
                echo PHP_EOL;
                die();
            }

            if (is_dir(PROJECT_PATH . 'apps/' . $this->name_module)) {
                echo $this->name_module . " directory already exists. Please remove this directory.";
                echo PHP_EOL;
                die();
            }

            //open configfile and get data
            echo "Reading configuration file...";
            echo PHP_EOL;
            $data = file_get_contents(PROJECT_PATH . "config/config.php");
            echo "Creating a backup of the configuration file...";
            echo PHP_EOL;
            // save backup
            if (file_put_contents(PROJECT_PATH . "config/config_backup.php", $data) === false) {
                echo 'Operation aborted! We can not write the configuration file backup.';
                echo PHP_EOL;
                echo 'Check the directory "config" in the record and povtoroite attempt.';
                die();
            }

            $prefix_router =
                !empty($params[1]) ? ($params[1] == 'null' ? 'false' : "'" . $params[1] . "'") : "'" . $this->name_module . "'";
            $host_name     = !empty($params[2]) && $params[2] != 'null' ? "'" . $params[2] . "'" : 'false';

            $new_module = sprintf("'%s'  => [
            'dir' => PROJECT_PATH . 'apps/%s/',
            'className' => 'Apps\%s\Module',
            'prefix_router' => %s,
            'host_name' => %s
        ],
        'frontend'", $this->name_module, $this->name_module, $this->name_namespace, $prefix_router, $host_name);

            // do tag replacements or whatever you want
            $data = str_replace("'frontend'", $new_module, $data);

            echo "Record changes in the configuration file...";
            echo PHP_EOL;
            //save config file:
            if (file_put_contents(PROJECT_PATH . "config/config.php", $data) === false) {
                print 'ABORTING!. Configuration Error writing file.';
                die();
            }

            echo "Create directories and files for this new module...";
            echo PHP_EOL;

            $src = PROJECT_PATH . 'config/template_module';
            $dst = PROJECT_PATH . 'apps/' . $this->name_module;

            if ($this->_my_copy_all($src, $dst) === true) {
                echo "Installing the module is complete!";
                echo PHP_EOL;
                echo "Use with pleasure!";
                echo PHP_EOL;
            } else {
                echo "Oops... Something went wrong!";
                echo PHP_EOL;
                echo "Module installation error! :(";
                echo PHP_EOL;
            }


        }
    }

    /**
     * Copies files and non-empty directories
     *
     * @link http://php.net/manual/en/function.copy.php#104020
     *
     * @param $src
     * @param $dst
     *
     * @return bool
     */
    private function _my_copy_all($src, $dst)
    {

        if (file_exists($dst)) {
            rrmdir($dst);
        }
        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $this->_my_copy_all("$src/$file", "$dst/$file");
                }
            }
        } else if (file_exists($src)) {
            copy($src, $dst);

            $data = file_get_contents($dst);

            $healthy = ["%date%", "%time%", "%namec%", "%name%"];
            $yummy   = [date('d.m.Y'), date('H:s'), $this->name_namespace, $this->name_module];

            // do tag replacements or whatever you want
            $data = str_replace($healthy, $yummy, $data);

            $path_parts = pathinfo($dst);
            // replace the extension of the text on php
            if ($path_parts['extension'] == 'txt') {
                unlink($dst);
                $dst = $path_parts['dirname'] . '/' . $path_parts['filename'] . '.php';
            }

            if (file_put_contents($dst, $data) === false) {
                print 'ABORTING!. ' . $dst . ' Error writing file.';
                die();
            }
        };

        return true;
    }

}