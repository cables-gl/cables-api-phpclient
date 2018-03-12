<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 14.02.18
 * Time: 13:15
 */

namespace Cables\Api;

use Cables\Api\Interfaces\Config;
use Cables\Api\Model\Patch;
use Cables\Api\Model\PatchExport;
use GuzzleHttp\Psr7\Response;

class CablesApi {
    /**
     * @var Config
     */
    private $config;

    /**
     * CablesApi constructor.
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * @return Patch[]
     */
    public function getMyPatches(): array {
        $response = $this->callRemote($this->config->getApiUrl(), '/myprojects');
        $body = (string)$response->getBody();
        $jsonpatches = json_decode($body);
        $patches = array();
        foreach ($jsonpatches as $jsonpatch) {
            $patches[] = Patch::fromJson($jsonpatch);
        }
        return $patches;
    }

    /**
     * @param string $baseUrl
     * @param string $method
     * @return Response
     */
    private function callRemote(string $baseUrl, string $method): Response {
        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            $baseUrl . $method,
            [
                'read_timeout' => 120,
                'headers' => [
                    'X-apikey' => $this->config->getApiKey(),
                ]
            ]
        );

        return $response;
    }

    /**
     * @param Patch $patch
     * @return Patch
     */
    public function importPatch(Patch $patch): Patch {

        $export = $this->getPatchExport($patch);
        $response = $this->callRemote($this->config->getBaseUrl(), $export->getPath());
        $content = (string)$response->getBody();

        $storage = $this->config->getStorage();
        $storage->storePatch($export, $content);
        return $patch;
    }

    /**
     * @return string
     */
    private function getPatchExport(Patch $patch): PatchExport {
        $response = $this->callRemote($this->config->getApiUrl(), '/project/' . $patch->getId() . '/export');
        $body = (string)$response->getBody();
        $json = json_decode($body);
        return PatchExport::fromJson($patch->getId(), $json);
    }

    /**
     * @param $patchId
     * @return bool
     */
    public function isImported(Patch $patch): bool {
        $storage = $this->config->getStorage();
        return $storage->isImported($patch);
    }

    /**
     * @param Patch $patch
     * @return string
     *
     */
    public function getPatchDirUrl(Patch $patch): string {
        $storage = $this->config->getStorage();
        return $storage->getPatchDirUrl($patch);
    }

    public function deletePatch(Patch $patch) {
        $storage = $this->config->getStorage();
        $storage->deletePatch($patch);
    }


    public function updatePatch(Patch $patch): Patch {
        $storage = $this->config->getStorage();
        $storage->deletePatch($patch);
        $this->importPatch($patch);
        return $patch;
    }

}
