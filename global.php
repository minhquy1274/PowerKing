<?php
session_start();
$ROOT_URL = "/fstudio";
$CONTENT_URL = "$ROOT_URL/content";
$ADMIN_URL = "$ROOT_URL/admin";
$SITE_URL = " $ROOT_URL/site";
$IMAGE_DIR = $_SERVER["DOCUMENT_ROOT"] . "$ROOT_URL/content/Image";
$VIEW_NAME = "index.php";
$MESSAGE = "";