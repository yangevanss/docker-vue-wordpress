<?php
function get_languages() {
    return [
        "current" => wpm_get_language(),
        "list" => array_map(function ($lang, $lang_key) {
            return [
                "text" => $lang["name"],
                "locale" => $lang["locale"],
                "key" => $lang_key,
                "link" => wpm_translate_url(get_site_url() . '/' . get_page_uri(), $lang_key),
                "active" => $lang_key !== wpm_get_language(),
            ];
        }, wpm_get_languages(), array_keys(wpm_get_languages()))
    ];
}