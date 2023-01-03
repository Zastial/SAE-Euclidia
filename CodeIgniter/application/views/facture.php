<?php
$this->output->set_header('Content-Type: application/pdf');
if(is_null($f) || is_null($u)) redirect('User/account');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetAuthor('Euclidia - 3D Models');
$pdf->SetTitle('Votre Facture du ' . $f->getDate());
$pdf->SetSubject('Facture');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->SetHeaderData("euclidia_lodgo.jpg", 90, '', );
$pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, '', '', array(
    0,
    0,
    0
), array(
    255,
    255,
    255
));
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

$html = '<br>
<h1 style="text-align:left">Votre facture du '. $f->getDate() . '</h1>
    <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">FACTURE</div>
    </div>
<table style="line-height: 1.5;">
    <tr><td><b>Facture:</b> #' . $f->getId() . '
        </td>
        <td style="text-align:right;"><b>'.$u->getNom(). ' ' . $u->getPrenom() . '</b></td>
    </tr>
    <tr>
        <td><b>Date:</b> '.$f->getDate().'</td>
        <td style="text-align:right;"><b></b>'.$f->getNumeroRue(). ', ' . $f->getAdresse() . '</td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align:right;"><b></b>'.$f->getCodePostal(). ', ' . $f->getVille() . '</td>
    </tr>
    <tr>
    <td></td>
    <td style="text-align:right;"><b></b>'.$f->getPays(). '</td>
    </tr>
    
</table>
<div></div>
<div style="border-bottom:1px solid #000;">
        <table style="line-height: 2;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border:1px solid #cccccc;width:250px;">Description</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:110px">Prix (€)</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:140px">Sous-total (€)</td>
            </tr>';
$sub = 0;
foreach ($a as $prod){
    $sub+=$prod[1];
    $html .= '
    <tr> <td style="border:1px solid #cccccc;">'.$prod[0].'</td>
        <td style = "text-align:right; border:1px solid #cccccc;">'.$prod[1].'</td>
        <td style = "text-align:right; border:1px solid #cccccc;">'.$sub.'</td>
    </tr>
    ';
}
$html .= '

<tr style = "font-weight: bold;">
    <td></td><td></td>
    <td style = "text-align:right;">Total (€) : '.$sub.'</td>
</tr>
</table></div>
<p><b>Nous vous remercions de votre commande.</b><br/>
Euclidia S.A. - Modèles 3D<br/>
A/C: 05346346543634563423<br/>
BIC: 23141434<br/>
</p>
<p><i>Note: Pour plus d\'informations, veuillez envoyer un mail à : <a href="mailto://contact@euclidia.com">contact@euclidia.com</a></i></p>
</body>
';
$pdf->writeHTML($html);
$pdf->Output('EuclidiaFacture'.$f->getDate());
?>
