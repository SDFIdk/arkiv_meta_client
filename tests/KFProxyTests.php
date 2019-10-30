<?php
    include_once __DIR__.'/../Classes/KFProxy.php';

    $proxy = new KFProxy("");

    assert(!$proxy->urlHostIsWhitelisted(), "Empty url should not validate");

    $proxy->setUrl("https://services.kortforsyningen.dk/rest/arkivkort/iiif/2/Lzk2IC0gdG9wb2dyYWZpc2tlIGtvcnQsIGVrc3Rlcm5lLzk2LTIxIFRyYXAvNTA4L3RyXzIwMDY2NTEuanBn");
    assert($proxy->urlHostIsWhitelisted(), "Realworld example should validate");

    $proxy->setUrl("http://services.kortforsyningen.dk/rest/arkivkort/iiif/2/Lzk2IC0gdG9wb2dyYWZpc2tlIGtvcnQsIGVrc3Rlcm5lLzk2LTIxIFRyYXAvNTA4L3RyXzIwMDY2NTEuanBn");
    assert(!$proxy->urlHostIsWhitelisted(), "Non https should not validate");

    $proxy->setUrl("https://evilhost.example.com/");
    assert(!$proxy->urlHostIsWhitelisted(), "Other hosts should not validate");

    $proxy->setUrl("https://services.kortforsyningen.dk.evilhost.example.com/");
    assert(!$proxy->urlHostIsWhitelisted(), "Other hosts containing valid subdomain should not validate");
