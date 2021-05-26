<?php

// PROFILING
defined('AUTHORS')          ? null : define('AUTHORS',          ['iLyas Farawe', 'Kamsi Kodi']);
defined('APP_NAME')         ? null : define('APP_NAME',         'Mergers Notification Portal');
defined('SHORT_APP_NAME')   ? null : define('SHORT_APP_NAME',   'MNP');
defined('COMPANY')          ? null : define('COMPANY',          'techbarn');
defined('COMPANY_LINK')     ? null : define('COMPANY_LINK',     'https://techbarn.ng');
defined('AGENCY')           ? null : define('AGENCY',           'FCCPC');
defined('AGENCY_LINK')      ? null : define('AGENCY_LINK',      'http://fccpc.gov.ng');

// DIRECTORIES
defined('DS')               ? null : define('DS',               '/');
defined('ASSETS')           ? null : define('ASSETS',           DS.'assets'.DS);

defined('CSS')              ? null : define('CSS',              ASSETS.'css'.DS);
defined('IMAGE')            ? null : define('IMAGE',            ASSETS.'images'.DS);
defined('JS')               ? null : define('JS',               ASSETS.'javascript'.DS);

defined('FE_ASSETS')        ? null : define('FE_ASSETS',        ASSETS.'frontend'.DS);
defined('BE_ASSETS')        ? null : define('BE_ASSETS',        ASSETS.'backend'.DS);

defined('FE_CSS')           ? null : define('FE_CSS',           FE_ASSETS.'css'.DS);
defined('FE_IMAGE')         ? null : define('FE_IMAGE',         FE_ASSETS.'images'.DS);
defined('FE_JS')            ? null : define('FE_JS',            FE_ASSETS.'javascript'.DS);

defined('BE_CSS')           ? null : define('BE_CSS',           BE_ASSETS.'css'.DS);
defined('BE_IMAGE')         ? null : define('BE_IMAGE',         BE_ASSETS.'images'.DS);
defined('BE_JS')            ? null : define('BE_JS',            BE_ASSETS.'javascript'.DS);
defined('BE_PLUGIN')        ? null : define('BE_PLUGIN',        BE_ASSETS.'plugins'.DS);
defined('BE_MEDIA')         ? null : define('BE_MEDIA',         BE_ASSETS.'media'.DS);

defined('BE_APP_JS')        ? null : define('BE_APP_JS',        BE_JS.'app'.DS);
defined('BE_LAYOUT_ASSETS') ? null : define('BE_LAYOUT_ASSETS', ASSETS.'backend'.DS.'layout'.DS);
defined('BE_LAYOUT_CSS')    ? null : define('BE_LAYOUT_CSS',    BE_LAYOUT_ASSETS.'css'.DS);
defined('BE_LAYOUT_IMAGE')  ? null : define('BE_LAYOUT_IMAGE',  BE_LAYOUT_ASSETS.'images'.DS);
defined('BE_LAYOUT_JS')     ? null : define('BE_LAYOUT_JS',     BE_LAYOUT_ASSETS.'javascript'.DS);
defined('BE_LAYOUT_PLUGIN') ? null : define('BE_LAYOUT_PLUGIN', BE_LAYOUT_ASSETS.'plugins'.DS);
defined('BE_LAYOUT_MEDIA')  ? null : define('BE_LAYOUT_MEDIA',  BE_LAYOUT_ASSETS.'media'.DS);
