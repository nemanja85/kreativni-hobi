<?php

return [
	'storekey' => env('STOREKEY', false),
	'aikUrl' => env('AIKURL', 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate'),
	'aikSuccess' => env('AIKSUCCESSURL', 'http://kreativnihobi.bgsvetionik.com/3DSuccessResult'),
	'aikFail' => env('AIKFAILURL', 'http://kreativnihobi.bgsvetionik.com/3DFailResult'),
	'storetype' => env('STORETYPE', '3d_pay_hosting'),
	'auth' => env('AUTH', 'Auth'),
	'currencyVal' => env('CURRENCYVAL', '941'),
	'clientId' => env('CLIENTID', false),
	'refreshtime' => env('REFRESHTIME', 5),
];