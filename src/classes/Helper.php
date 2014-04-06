<?php
namespace Nifus\AdminPanel;

class Helper
{

    /**
     *
     */
    static function loadConfig($file){
        $file = app_path().'/config/packages/nifus/admin-panel/'.$file.'.php';
        if ( !file_exists($file) ){
            return false;
        }
        $config = require $file;

        $structure = $config();
        return $structure;
    }

    static function CheckPrefix($prefix){
        if ( empty($prefix) ){
            return false;
        }
        if ( preg_match('#[^a-z0-9_]#i',$prefix) ){
            return false;
        }
        return true;
    }

    /**
     * scan dir and subdirs
     *
     * @param string $root
     * @return array
     */
    static function readAllFiles($root = '.')
    {

        $files = array('files' => array(), 'dirs' => array());
        $directories = array();
        $last_letter = $root[strlen($root) - 1];
        $root = ($last_letter == '\\' || $last_letter == '/') ? $root : $root . DIRECTORY_SEPARATOR;
        $directories[] = $root;
        while (sizeof($directories)) {
            $dir = array_pop($directories);
            if (false === file_exists($dir)) {
                continue;
            }
            if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    $file = $dir . $file;
                    if (is_dir($file)) {
                        $directory_path = $file . DIRECTORY_SEPARATOR;
                        array_push($directories, $directory_path);
                        $files['dirs'][] = $directory_path;
                    } elseif (is_file($file)) {
                        $files['files'][] = $file;
                    }
                }
                closedir($handle);
            }
        }
        return $files;
    }
}