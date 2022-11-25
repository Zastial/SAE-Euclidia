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
        <td style="text-align:right;"><b>A destination de: </b>'.$u->getNom(). ' ' . $u->getPrenom() . '</td>
    </tr>
    <tr>
        <td><b>Date:</b> '.$f->getDate().'</td>
    </tr>
</table>';

$html .= '
<div></div>
    <div style="border-bottom:1px solid #000;">
        <table style="line-height: 2;">
            <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
                <td style="border:1px solid #cccccc;width:200px;">Item Description</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:85px">Price ($)</td>
                <td style = "text-align:right;border:1px solid #cccccc;width:75px;">Quantity</td>
                <td style = "text-align:right;border:1px solid #cccccc;">Subtotal ($)</td>
            </tr>
<?php
$total = 0;
$productModel = new Order();
foreach ($orderItemResult as $k => $v) {
    $price = $orderItemResult[$k]["item_price"] * $orderItemResult[$k]["quantity"];
    $total += $price;
    $productResult = $productModel->getProduct($orderItemResult[$k]["product_id"]);
    ?>
    <tr> <td style="border:1px solid #cccccc;"><?php echo $productResult[0]["product_title"]; ?></td>
                    <td style = "text-align:right; border:1px solid #cccccc;"><?php echo number_format($orderItemResult[$k]["item_price"], 2); ?></td>
                    <td style = "text-align:right; border:1px solid #cccccc;"><?php echo $orderItemResult[$k]["quantity"]; ?></td>
                    <td style = "text-align:right; border:1px solid #cccccc;"><?php echo number_format($price, 2); ?></td>
               </tr>
<?php
}
?>
<tr style = "font-weight: bold;">
    <td></td><td></td>
    <td style = "text-align:right;">Total ($)</td>
    <td style = "text-align:right;"><?php echo number_format($total, 2); ?></td>
</tr>
</table></div>
<p><u>Kindly make your payment to</u>:<br/>
Bank: American Bank of Commerce<br/>
A/C: 05346346543634563423<br/>
BIC: 23141434<br/>
</p>
<p><i>Note: Pour plus d\'informations, veuillez envoyer un mail à : <a href="mailto://test@gmail.com">test@gmail.com</a></i></p>
</body>
';
$pdf->writeHTML($html);
$pdf->Output('EuclidiaFacture'.$f->getDate());
?>
