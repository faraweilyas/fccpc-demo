<?php

// PROFILING
defined('AUTHORS') 				? NULL : define('AUTHORS', 				["Kamsi Kodi"]);
defined('APP_NAME') 			? NULL : define('APP_NAME',				"grubeats");
defined('COMPANY') 				? NULL : define('COMPANY',				"grubeat");
defined('COMPANY_LINK') 		? NULL : define('COMPANY_LINK',			"https://grubeats.com");
defined('APP_URL') 				? NULL : define('APP_URL',				"http://localhost:8000");
defined('APP_EMAIL') 			? NULL : define('APP_EMAIL',		    "kamsikodi@gmail.com");
defined('GOOGLE_KEY') 			? NULL : define('GOOGLE_KEY',			"AIzaSyBwF3kU5pZ9X8Z_NacpyJDzZn3Q0pnO8OY");

//DIRECTORIES
defined('DS') 					? NULL : define('DS',					"/");
defined('PUBLIC_DIR') 			? NULL : define('PUBLIC_DIR',			APP_URL.DS);

defined('ASSET') 				? NULL : define('ASSET', 				PUBLIC_DIR."assets".DS);

defined('BACKEND_ASSET') 		? NULL : define('BACKEND_ASSET', 		ASSET."backend".DS);
defined('FRONTEND_ASSET') 		? NULL : define('FRONTEND_ASSET', 		ASSET."frontend".DS);

defined('BE_CSS') 				? NULL : define('BE_CSS', 				BACKEND_ASSET."css".DS);
defined('BE_IMAGE') 			? NULL : define('BE_IMAGE', 			BACKEND_ASSET."images".DS);
defined('BE_JS') 				? NULL : define('BE_JS', 				BACKEND_ASSET."js".DS);
defined('BE_MEDIA') 			? NULL : define('BE_MEDIA', 			BACKEND_ASSET."media".DS);
defined('BE_PLUGIN') 			? NULL : define('BE_PLUGIN', 			BACKEND_ASSET."plugins".DS);

defined('FE_CSS') 				? NULL : define('FE_CSS', 				FRONTEND_ASSET."css".DS);
defined('FE_IMAGE') 			? NULL : define('FE_IMAGE', 			FRONTEND_ASSET."images".DS);
defined('FE_JS') 				? NULL : define('FE_JS', 				FRONTEND_ASSET."js".DS);

defined('APP_LOGO') 			? NULL : define('APP_LOGO', 			FE_IMAGE."logo/app_logo.png");