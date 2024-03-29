<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['validate'] = 'Main/login_validation';
$route['spmc'] = 'SputumCollection';
$route['sca'] = 'SpecimenCodeAssign';
$route['Ctest'] = 'Ctest';
$route['menu'] = 'Menu';
$route['vemps'] = 'ViewEmployees';
$route['pulmoeval'] = 'PulmonaryEvaluation';
$route['si'] = 'StartIncubation';
$route['eljr'] = 'EncodeLJResult';
$route['emgitr'] = 'EncodeMGITResult';
$route['dst'] = 'DrugSusceptibilityTest';
$route['es'] = 'EnteringSmear';
$route['vtrans'] = 'ViewTransactions';
$route['fcr'] = 'FinalCultureResult';
$route['default_controller'] = 'main';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;