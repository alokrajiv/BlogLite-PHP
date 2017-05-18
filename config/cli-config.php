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

require_once __DIR__ . "/../bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
