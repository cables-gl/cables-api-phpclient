<?php
/**
 * Created by IntelliJ IDEA.
 * User: stephan
 * Date: 12.03.18
 * Time: 14:35
 */

namespace Cables\Api\Interfaces;


use Cables\Api\Model\Patch;
use Cables\Api\Model\PatchExport;

interface Storage {

    public function storePatch(PatchExport $export, string $content);

    public function isImported(Patch $patch): bool;

    public function getPatchDirUrl(Patch $patch): string;

    public function deletePatch(Patch $patch);
}
