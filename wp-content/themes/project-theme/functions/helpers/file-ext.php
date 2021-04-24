<?php
// 目的：取得檔案型別
function getFileExt($filename) {
    return $ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
}