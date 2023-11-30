<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once __DIR__ . '/vendor/autoload.php';
class Pdf
{
    public function create($html, $css, $filename, $set = array())
    {
        $set['mode'] = $set['mode'] ? $set['mode'] : "utf-8";
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/fonts',
            ]),
            'fontdata' => $fontData + [
                'sarabun' => [
                    'R' => 'thaisansneue-regular-webfont.ttf',
                    'I' => 'thaisansneue-Italic-webfont.ttf',
                    'B' =>  'thaisansneue-bold-webfont.ttf',
                ]
            ],
            'mode' => $set['mode'],
            'format' => 'A4',
            'orientation' => 'L'
        ]);
        $herder = '<link href="' . base_url('vendor/bootstrap/css/bootstrap.css') . ' rel="stylesheet">';
        $css = 'div {font-family: "sarabun";}' . $css;
        $content = '
        
        <div class="container-sm" style="width: 100%; " >
            <div class="row">
                <div style="float: right; width: 80%; background:rgba(211, 211, 211, 0.3);">
                    <div style="float: both; width: 90%; padding: 10px 10px; display: flex; justify-content: center; align-items: center;">
                    ' . $html . '
                    </div>
                </div>
            </div>
        </div>
        ';

        $mpdf->SetHTMLHeader($herder);
        $mpdf->SetDefaultBodyCSS('background', "base_url('images/background/page-login.jpg')");
        $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($content, 2);
        $mpdf->Output($filename . '.pdf', 'I');
    }
}
