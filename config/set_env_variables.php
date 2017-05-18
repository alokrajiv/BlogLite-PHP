<?php

/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

if (!getenv("CUSTOMCONNSTR_PROD")) {
    //loading dev_env.php if not production
    require_once __DIR__ . "/dev_env.php";
    putenv("BASE_DIR=" . __DIR__ . "/../");
}