<?php
require_once 'context-data/context-data.php';

if (is_tag()) {
    // 標籤
    include 'query/tag.php';
    Timber::render('tag.twig', $context);
} elseif (is_post_type_archive('news') || is_tax('news_category')) {
    // news 並且有類別
    include 'query/archive-news.php';
    Timber::render('archive-news.twig', $context);
} else {
    // 其餘全數生成偽裝 404
    include 'functions/helpers/redirect-404.php';
}
