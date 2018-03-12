<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 12.03.18
 * Time: 14:38
 */

namespace Cables\Api;

use Cables\Api\Interfaces\Storage;
use Cables\Api\Model\Patch;
use Cables\Api\Model\PatchExport;
use VIPSoft\Unzip\Unzip;

class TestStorage implements Storage {

    /**
     * @param PatchExport $export
     * @param mixed $content
     * @return Patch
     * @throws \Exception
     */
    public function storePatch(PatchExport $export, string $content) {

        $upload_dir = sys_get_temp_dir();
        $filename = $upload_dir . '/' . $export->getId() . '.zip';

        file_put_contents($filename, $content);

        $destination_path = $this->getPatchDestinationPath($export->getId());

        $unzipper = new Unzip();
        $unzipper->extract($filename, $destination_path);

    }

    public function getPatchDestinationPath($patchId): string {
        $dir = sys_get_temp_dir() . '/public/patches/' . $patchId . '/';
        return $dir;
    }

    public function isImported(Patch $patch): bool {
        $filename = $this->getPatchDestinationPath($patch->getId()) . '/cables.txt';
        return file_exists($filename);
    }

    public function getPatchDirUrl(Patch $patch): string {
        return 'https://www.example.com/patches/' . $patch->getId() . '/';
    }

    public function deletePatch(Patch $patch) {
        $dir = $this->getPatchDir($patch->getId());
        $this->rrmdir($dir);
    }

    private function getPatchDir($patchId): string {
        return sys_get_temp_dir() . '/public/patches/' . $patchId . '/';
    }

    private function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir"){
                        $this->rrmdir($dir."/".$object);
                    }else{
                        unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
