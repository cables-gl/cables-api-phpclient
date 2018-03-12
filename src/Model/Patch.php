<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 07.02.18
 * Time: 10:18
 */

namespace Cables\Api\Model;


class Patch {

    private $id;
    private $name;
    private $userId;
    private $tags;
    private $cachedUsername;
    private $isPrivate;
    private $publishedReadable;

    /**
     * Patch constructor. Private, use factory-method
     */
    private function __construct() {
    }

    /**
     * @param \stdClass $json
     * @return Patch
     */
    public static function fromJson(\stdClass $json): Patch {
        $patch = new Patch();
        $patch->setId($json->_id);
        $patch->setName($json->name);
        $patch->setUserId($json->userId);
        $patch->setTags($json->tags);
        $patch->setCachedUsername($json->cachedUsername);
        if(isset($json->isPrivate)) {
            $patch->setIsPrivate($json->isPrivate);
        }
        $patch->setPublishedReadable($json->publishedReadable);
        return $patch;
    }

    /**
     * @param mixed $id
     */
    private function setId($id) {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    private function setName($name) {
        $this->name = $name;
    }

    /**
     * @param mixed $userId
     */
    private function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     * @param mixed $tags
     */
    private function setTags($tags) {
        $this->tags = $tags;
    }

    /**
     * @param mixed $cachedUsername
     */
    private function setCachedUsername($cachedUsername) {
        $this->cachedUsername = $cachedUsername;
    }

    /**
     * @param mixed $isPrivate
     */
    private function setIsPrivate($isPrivate) {
        $this->isPrivate = $isPrivate;
    }

    /**
     * @param mixed $publishedReadable
     */
    private function setPublishedReadable($publishedReadable) {
        $this->publishedReadable = $publishedReadable;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getCachedUsername() {
        return $this->cachedUsername;
    }

    /**
     * @return mixed
     */
    public function getisPrivate() {
        return $this->isPrivate;
    }

    /**
     * @return mixed
     */
    public function getPublishedReadable() {
        return $this->publishedReadable;
    }


}
