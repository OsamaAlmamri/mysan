<?php

namespace RehanTariq\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RehanTariq\LaravelInstaller\Helpers\RequirementsChecker;
use Session;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
         $requirements = array('php' => array(
           'openssl',
           'pdo',
           'mbstring',
           'tokenizer',
           'JSON',
           'cURL'));
         $minPhpVersion = 'minPhpVersion';

        $phpSupportInfo = $this->requirements->checkPHPversion(
            $minPhpVersion
        );
        $requirements = $this->requirements->check(
            $requirements
        );
        return view('vendor.installer.requirements', compact('requirements', 'phpSupportInfo'));
    }
}
