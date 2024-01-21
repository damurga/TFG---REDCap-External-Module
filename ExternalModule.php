<?php

namespace ReportModule\ExternalModule;

use ExternalModules\AbstractExternalModule;
use RCView;
use REDCap;

class ExternalModule extends AbstractExternalModule {

    /*function redcap_module_project_enable($version, $project_id) {
        
    }*/

    function includeJs($path) {
        echo '<script src="' . $this->framework->getUrl($path, true) . '">;</script>';
    }


    function redcap_data_entry_form($project_id, $record, $instrument, $event_id, $group_id, $repeat_instance)
    {
        $dictionary = REDCap::getDataDictionary('json');
        /*$dictionary = $dd_array.'report,form_1,,notes,"REPORT GENERATED",,,,,,,,,,,,,';
        echo($dictionary);
        $path = '/var/www/html/formacion/redcap/redcap_v12.2.8/ExternalModules/example_modules/RyC_Report_Module_v0.0.0/dictionary.csv';
        //$this->framework->importDataDictionary($project_id,$path)	;
        
        /*$dictionary = $dd_array.'report,form_1,,text,"REPORT GENERATED",,,,,,,,,,,,,';
        print_r("<br>");
        print_r($dictionary);
        $path="dictionary.csv";
        $this->framework->importDataDictionary($project_id,$path);
        /*unset($dd_array['prueba_1']);
        print_r("<br>");
        print_r($dd_array);*/


        $this->includeJs("js/app.js");
        
        $RecordFieldsNames = REDCap::getFieldNames($instrument);
        //array_shift($RecordFieldsNames);
        array_pop($RecordFieldsNames);

        $ar = REDCap::getData(array('return_format'=>'array', 'project_id'=>$project_id, 'records'=>$record, 'fields'=>$RecordFieldsNames));

        /*if(json_encode(array_shift(array_values($ar)))["repeat_instances"]){

            $ar2 = reset($ar);
            $ar2 = reset($ar2);
        }*/


        $ar2=reset($ar);
        $RecordFieldsValues=reset($ar2);
        $RecordFieldsValues['report']="";
        $RecordFieldsValuesJSON = json_encode($RecordFieldsValues);



        
        echo '<form hidden method=post action=""><input style="white-space:pre-warp" type="text" name="Report" id="Report" value="" /><input type="submit" id="EnviarReport"></form>';
        echo "<input hidden type='text' name='idtest' id='RecordFieldsValues' value='$RecordFieldsValuesJSON' />";
        echo "<input hidden type='text' name='idtest2' id='ProjectDictionary' value='$dictionary' />";



        echo '<br><h3>GENERATE REPORT FROM DATA</h3><br><div>You can load a template in the text box from a TXT file:</div><br> 
            Select a File to Load:
            <input type="file" id="fileToLoad2">
            <button onclick="generateReport();">Generate report</button>
        </tr>';



        if(isset($_POST['Report'])){

            $ReportGenerated = $_POST['Report'];
            
            $json_data = '[{"record_id":'.$record.', "report":"'.$ReportGenerated.'"}]';

            // Import the data
            REDCap::saveData('json', $json_data, 'overwrite');
            header("Refresh:0");

            
            
        }

        
    } 


}


?>

