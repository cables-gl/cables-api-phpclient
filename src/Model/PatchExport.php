<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 14.02.18
 * Time: 13:35
 */

namespace Cables\Api\Model;


class PatchExport {

    private $size;
    private $path;
    private $log;
    private $id;

    /**
     * Shape constructor. Private, use factory-method
     */
    private function __construct() {
    }

    /**
     * @param $id
     * @param \stdClass $json
     * @return PatchExport
     */
    public static function fromJson($id, \stdClass $json): PatchExport {
        $export = new PatchExport();
        $export->setId($id);
        $export->setSize($json->size);
        $export->setPath($json->path);
        $export->setLog($json->log);
        return $export;
    }

    /**
     * @param mixed $size
     */
    private function setSize($size) {
        $this->size = $size;
    }

    /**
     * @param mixed $path
     */
    private function setPath($path) {
        $this->path = $path;
    }

    /**
     * @param mixed $log
     */
    private function setLog($log) {
        $this->log = $log;
    }

    /**
     * @return mixed
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getLog() {
        return $this->log;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }


}
