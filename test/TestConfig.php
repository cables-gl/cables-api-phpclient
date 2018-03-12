<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 12.03.18
 * Time: 14:11
 */

namespace Cables\Api;

use Cables\Api\Interfaces\Config;
use Cables\Api\Interfaces\Storage;

class TestConfig implements Config {

    /**
     * @return string
     */
    public function getApiKey() {
        return "428a2a3708e0df472bae620fe796ffb300332c9a62b7129989363b71a778786a133ca7711793bb4ded5fc27bbbb7e2fc";
    }

    /**
     * @return string
     */
    public function getApiUrl(): string {
        return $this->getBaseUrl() . '/api';
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string {
        return 'https://cables.gl';
    }

    /**
     * @return Storage
     */
    public function getStorage() {
        return new TestStorage();
    }
}
