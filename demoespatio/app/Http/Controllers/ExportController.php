<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AppInterfaces\InterfaceExport;

class ExportController {


public function exportData(InterfaceExport $exportService){


    $myservice='testing interface';
    
    $exporting=$exportService->exportData($myservice);

    echo $exporting;   

}
    
}