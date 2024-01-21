<style><?php include 'css/style.css'; ?></style>

<?php
use RCView;
use REDCap;

require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

//$title = RCView::img(['src' => APP_PATH_IMAGES . 'bell.png']) . ' ' . REDCap::escapeHtml('Control Center Page');
$title = REDCap::escapeHtml('Template Generation Page');

echo RCView::h4([], $title);

$module->includeJs("js/app.js");
$module->includeJs("js/FileSaver.js");

//$module->showProjectInstruments();

$instrument_names = REDCap::getInstrumentNames();

array_unshift($instrument_names, "-- Select an option --");

echo "<form method='post', action=''>";
echo RCView::label(['for' => 'instrument'], "Select a instrument to display fields", false);
echo RCView::select(['id' => 'instrument', 'name' => 'instrument'], $instrument_names);

echo "<input id='submission' type='submit' value='Select Instrument' disabled='true'/><br>";

echo "</form>";

if(isset($_POST['instrument'])){
    $instrument = array($_POST['instrument'], 'baseline_data');
    $fields = REDCap::getFieldNames($instrument);
    array_shift($fields);
    array_pop($fields);
    echo "You have selected the instrument ".$_POST['instrument'];
    echo "<br>";
    
    echo '<br><div>You can load a template in the text box from a TXT file:</div><br> 
    <tr id="select_file">
    <td>Select a File to Load:</td>
    <td><input type="file" id="fileToLoad"></td>
    <td><button onclick="loadFileAsText()">Load Selected File</button><td>
</tr>';


    echo '<br><br><div style="float:left; width:60%"><h3 style="text-align:center">TEXT BOX FOR WRITTING YOUR TEMPLATE</h3><textarea id="textarea" cols="120" rows="50" style="resize: both; title="TEXT BOX"></textarea><div style="text-align:center" ><input type="submit" id = "guardar_plantilla" value="Save template"></div></div>';
    echo '<br><br><div style="float:right; width:40%"><h3 style="text-align:center">INSTRUMENT FIELDS\' NAMES</h3>';
    foreach($fields as $clave => $valor){
        echo "{".$valor."}";
        echo "&nbsp; &nbsp; &nbsp;";
    };
    echo '<div style="position: absolute; bottom: 100px;" cols="70" rows="10"><h3 style="text-align:center">IS YOUR INSTRUMENT REPEATABLE?</h3>You can copy some text, fields or text + fields in this text box and field\'s name will be updated <br><div style="text-align:center"><br><textarea id="textarea_repeatable"  cols="70" rows="10" style="resize: both;"></textarea></div> <div style="text-align:center"><input type="button" id ="repeatable" value="Update Text"></div></div></div></div>';

    echo '</div>';


}

echo "<div id='textareaTitulo'></div>";

echo "<div id='textarea'></div>";

require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';