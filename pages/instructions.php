<?php

use RCView;
use REDCap;

require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

//$title = RCView::img(['src' => APP_PATH_IMAGES . 'bell.png']) . ' ' . REDCap::escapeHtml('Control Center Page');
$title = REDCap::escapeHtml('INSTRUCTIONS');

echo "<h2>INSTRUCTIONS</h2>";

echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";

echo "<h4>Template Generator Page</h4>";

echo '<div>1. Once you enable the Report Module you will notice two links in the REDCap side Menu: the "Instructions" link (the one you already access) and the "Template Generator" link.</div>';

echo '<br>';

echo '<div><img style=" width: 65%; height: auto;" src="example_modules/RyC_Report_Module_v0.0.0/pages/images/external_modules_page.png"/></div>';

echo '<br>';

echo '<div style="text-align: justify; margin-right: 20%;">2. You can click in the "Template Generator" link and you will be redirected to the template generator page. In this page, you will be asked to select an instrument from your project and after
you select It and press the "Select Instrument" button, a text box will be displayed so you can write the template for your Report. With the text box, It will also be displayed a "Select Field" button and a "INSTRUMENT VARIABLE NAMES" column 
containing the names of your instrument fields between brackets {}. Using the "Load Selected File" button you can upload your template in a .txt format and It will be loaded in the text box so you can edit It.</div>';

echo '<br>';

echo '<div><img style=" width: 40%; height: auto;" src="example_modules/RyC_Report_Module_v0.0.0/pages/images/template_generation_01.png"/></div>';

echo '<br>';

echo '<div><img style=" width: 65%; height: auto;" src="example_modules/RyC_Report_Module_v0.0.0/pages/images/template_generator_1.png"/></div>';

echo '<br>';

echo '<div style="text-align: justify; margin-right: 20%;">3. ¿How should you write your template? Well, in order to create a valid template you should write a Report as you would normally do but replacing the words corresponding to the values 
of your instrument fields with the names of the fields shown in the INSTRUMENT VARIABLE NAMES" column. In the above picture you can see a template example.</div>';

echo '<br>';

echo '<div style="text-align: justify; margin-right: 20%;">4. When you finish writing or editing the template you can download It in .txt format pressing the "Save template" button located under the text box.</div>';

echo '<br>';

echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";

echo "<h4>Record Page</h4>";

echo '<div style="text-align: justify; margin-right: 20%;">1. If you access one of the records saved in your project with the Report Module enabled you will notice an additional section ("GENERATE REPORT FROM DATA")
under the fields of your instrument. In this section you can upload the template you downloaded in .txt format.</div>';

echo '<br>';

echo '<div><img style=" width: 65%; height: auto;" src="example_modules/RyC_Report_Module_v0.0.0/pages/images/record_page_1.png"/></div>';

echo '<br>';

echo '<div style="text-align: justify; margin-right: 20%;">2. After you select the template and press the "Generate report" button, the report of your record will be displayed in the "report" field 
of your instrument</div>';

echo '<br>';

echo '<div><img style=" width: 65%; height: auto;" src="example_modules/RyC_Report_Module_v0.0.0/pages/images/report_page_2.png"/></div>';

echo '<br>';

echo '<div style="text-align: justify; margin-right: 20%;">IMPORTANT NOTE --> You must add the field for the report generation in the instruments you want to generate the report. This field 
must be of type NOTE BOX and It must be named "report".</div>';







