<?php
/**
 * Created by Artdevue.
 * User: artdevue - Trans.php
 * Date: 22.04.17
 * Time: 00:56
 * Project: phalcon-blank
 *
 * Class Trans
 * @package Library
 */

namespace Library;

use Phalcon\Mvc\User\Component;
use Phalcon\Translate\Adapter\NativeArray;

class Trans extends Component
{
    /**
     * Get param
     * Example in controller: $this->trans->_("validation.accepted", ['attribute' => 'test'])
     *
     * @access public
     * @return NativeArray
     */
    public function get()
    {
        $messages = [];
        // Ask browser what is the best message directory
        $message_dir =
            PROJECT_PATH . "apps/" . $this->config->name_lang_folder . "/" . $this->config->default_lang . "/";

        $dh = opendir($message_dir);
        while (false !== ($filename = readdir($dh)))
        {
            $info = new \SplFileInfo($message_dir . $filename);
            if ($info->getExtension() == 'php')
            {
                $basename = $info->getBasename('.php');
                $array    = $this->fetchArray($message_dir . $filename);
                $array    = array_combine(
                    array_map(create_function('$k', 'return "' . $basename . '.".$k;'), array_keys($array)),
                    $array
                );

                $messages = array_merge($messages, $array);
            }
        }

        // Return a message object
        return new NativeArray(
            [
                "content" => $messages,
            ]
        );
    }

    /**
     * @access private
     * @param $in
     * @return array|mixed
     */
    private function fetchArray($in)
    {
        if (is_file($in))
        {
            return include $in;
        }

        return [];
    }
}