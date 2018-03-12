<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 12.03.18
 * Time: 14:03
 */

namespace Cables\Api\Interfaces;

interface Config {

    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /*
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * @return string
     */
    public function getApiKey();

    /**
     * @return Storage
     */
    public function getStorage();

}
