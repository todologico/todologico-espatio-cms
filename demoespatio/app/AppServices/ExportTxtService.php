<?php

declare(strict_types=1);

namespace App\AppServices;

use App\AppInterfaces\InterfaceExport;

Class ExportTxtService implements InterfaceExport {


    /**
     * Export array to Excel
     * @param array
     *
     */

    public function exportData($myservice){

        $service ='array to txt '.$myservice;

        return $service;

    }

}