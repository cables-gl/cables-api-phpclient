<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 12.03.18
 * Time: 13:57
 */

namespace Cables\Api;

use PHPUnit\Framework\TestCase;

class CablesApiTest extends TestCase {

    /**
     * @var CablesApi
     */
    private $api;

    public function testGetPatches() {
        $myPatches = $this->api->getMyPatches();
        $this->assertNotEmpty($myPatches, "got no patches from cables backend");
        foreach ($myPatches as $myPatch) {
            $this->assertNotNull($myPatch->getId());
        }
    }

    public function testStorePatch() {
        $myPatches = $this->api->getMyPatches();
        $patch = $myPatches[0];
        $this->api->importPatch($patch);
        $this->assertTrue($this->api->isImported($patch), "could not find imported patch");
    }

    public function testUpdatePatch() {
        $myPatches = $this->api->getMyPatches();
        $patch = $myPatches[0];
        $this->api->updatePatch($patch);
        $this->assertTrue($this->api->isImported($patch), "could not find updated patch");
    }

    public function testDeletePatch() {

        $myPatches = $this->api->getMyPatches();
        $patch = $myPatches[0];
        $this->api->deletePatch($patch);
        $this->assertFalse($this->api->isImported($patch), "patchfiles still exists");

    }

    protected function setUp() {
        $this->api = new CablesApi(new TestConfig());
    }

}
