<?php

declare(strict_types=1);

namespace App\AppServices;

use App\AppInterfaces\InterfaceExport;

Class ExportPdfService implements InterfaceExport {


    /**
     * Export array to Excel
     * @param array
     *
     */

    public function exportData($myservice){

        $service ='array to pdf '.$myservice;

        return $service;

    }


}