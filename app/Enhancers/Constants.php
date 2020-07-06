<?php

// PROFILING
defined('AUTHORS') 				? NULL : define('AUTHORS', 				["iLyas Farawe", "Kamsi Kodi"]);
defined('APP_NAME') 			? NULL : define('APP_NAME',				"MAP - Mergers & Acquisition Platform");
defined('SHORT_APP_NAME') 		? NULL : define('SHORT_APP_NAME',		"MAP");
defined('COMPANY') 				? NULL : define('COMPANY',				"techbarn");
defined('COMPANY_LINK') 		? NULL : define('COMPANY_LINK',			"https://techbarn.ng");
defined('AGENCY') 				? NULL : define('AGENCY',				"FCCPC");
defined('AGENCY_LINK') 			? NULL : define('AGENCY_LINK',			"http://fccpc.gov.ng");

// DIRECTORIES
defined('DS') 					? NULL : define('DS',					"/");
defined('ASSETS') 				? NULL : define('ASSETS', 				DS."assets".DS);

defined('CSS') 					? NULL : define('CSS', 					ASSETS."css".DS);
defined('IMAGE') 				? NULL : define('IMAGE', 				ASSETS."images".DS);
defined('JS') 					? NULL : define('JS', 					ASSETS."javascript".DS);

defined('FE_ASSETS') 			? NULL : define('FE_ASSETS', 			ASSETS."frontend".DS);
defined('BE_ASSETS') 			? NULL : define('BE_ASSETS', 			ASSETS."backend".DS);

defined('FE_CSS') 				? NULL : define('FE_CSS', 				FE_ASSETS."css".DS);
defined('FE_IMAGE') 			? NULL : define('FE_IMAGE', 			FE_ASSETS."images".DS);
defined('FE_JS') 				? NULL : define('FE_JS', 				FE_ASSETS."javascript".DS);

defined('BE_CSS') 				? NULL : define('BE_CSS', 				BE_ASSETS."css".DS);
defined('BE_IMAGE') 			? NULL : define('BE_IMAGE', 			BE_ASSETS."images".DS);
defined('BE_JS') 				? NULL : define('BE_JS', 				BE_ASSETS."javascript".DS);
defined('BE_PLUGIN') 			? NULL : define('BE_PLUGIN', 			BE_ASSETS."plugins".DS);
defined('BE_MEDIA') 			? NULL : define('BE_MEDIA', 			BE_ASSETS."media".DS);

defined('BE_APP_JS')            ? NULL : define('BE_APP_JS',            BE_JS."app".DS);
