<?php
class Coba extends FPDF
{

    public function Footer()
    {
        $this->SetY(-40);
        $this->SetLeftMargin(20);
        $this->Ln(1);
        $this->SetLineWidth(1, 5);
        $this->Line(20, 555, 820, 555);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(400, 10, 'Dicetak pada ' . date('d/m/Y') . ' | &copy;  SMK PASIM Plus Sukabumi', 0, 0, 'L');
        $this->Cell(400, 10, 'halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'R');
    }
}

$pdf = new Coba('L', 'pt', 'A4');
$pdf->SetTitle('Laporan Rekapitulasi Guru');
$pdf->AliasNbPages();
$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->SetAutoPageBreak(true, 50);

$pdf->AddPage();
$pdf->Image('./assets/img/logo.png', 210, 21, 50);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(70);
$pdf->Cell(650, 10, 'SEKOLAH MENENGAH KEJURUAN', 0, 0, 'C');
$pdf->Ln(14);
$pdf->SetFont('helvetica', '', 14);
$pdf->Cell(70);
$pdf->Cell(650, 10, 'S M K  P A S I M  P L U S  S U K A B U M I', 0, 0, 'C');
$pdf->Ln(14);
$pdf->Cell(70);
$pdf->SetFont('helvetica', 'I', 9);
$pdf->Cell(650, 10, 'Graha Pasim Jalan Prana No. 8A Cikole Kota Sukabumi Telp. (0266) 241000', 0, 0, 'C');
$pdf->SetLineWidth(1);
$pdf->Line(20, 72, 820, 72);
$pdf->SetLineWidth(1, 5);
$pdf->Line(20, 74, 820, 74);



$pdf->SetY(110);
$pdf->SetFont('helvetica', 'BU', 13);
$pdf->Cell(0, 10, $title, 0, 0, 'C');
$pdf->Ln(25);


$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLineWidth(1, 5);
$pdf->SetFillColor(0, 191, 255);
$pdf->Cell(20, 15, "No", 1, "LR", "C", true);
$pdf->Cell(80, 15, "NIP", 1, "LR", "C", true);
$pdf->Cell(120, 15, "Nama Guru", 1, "LR", "C", true);
$pdf->Cell(130, 15, "Tempat, Tanggal Lahir", 1, "LR", "C", true);
$pdf->Cell(150, 15, "Alamat", 1, "LR", "C", true);
$pdf->Cell(100, 15, "No Telp", 1, "LR", "C", true);
$pdf->Cell(150, 15, "Jurusan", 1, "LR", "C", true);
$pdf->Cell(50, 15, "Status", 1, "LR", "C", true);
if (!empty($guru)) {
    $pdf->SetLeftMargin(20);
    $pdf->Ln();
    $no = 0;
    $curY = $pdf->GetY();
    $curN = 0;
    $akhir = 0;
    foreach ($guru as $gr) {
        if ($gr['is_active'] == 1) {
            $active = 'Aktif';
        } else {
            $active = 'Tidak Aktif';
        }

        $no++;
        $yAwal = $pdf->GetY();
        $xAwal = $pdf->GetX();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->Cell(20, 15, $no . ".", 'LRT', 0, "C");
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->MultiCell(80, 15, $gr['nip'], 'LRT', 'C');
        $pdf->SetXY($pdf->GetX() + 100, $curY);
        $pdf->MultiCell(120, 15, $gr['namaguru'], 'LRT', 'L');
        $pdf->SetXY($pdf->GetX() + 220, $curY);
        $pdf->MultiCell(130, 15, $gr['tempatlahir'] . " \n" . $gr['tgllahir'], 'LRT', 'L');
        $curA = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 350, $curY);
        $pdf->MultiCell(150, 15, $gr['alamatguru'], 'lRT', "L");
        $curJ = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 500, $curY);
        $pdf->MultiCell(100, 15, $gr['notelpseluler'], 'LRT', "C");
        $curS = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 600, $curY);
        $pdf->MultiCell(150, 15, $gr['namajurusan'], 'LRT', "L");
        $pdf->SetXY($pdf->GetX() + 750, $curY);
        $pdf->MultiCell(50, 15, $active, 'LRT', "C");
        if (($curA >= $curJ) && ($curA >= $curS)) {
            $curN = $curA;
        } else if (($curJ >= $curA) && ($curJ >= $curS)) {
            $curN = $curJ;
        } else if (($curS >= $curA) && ($curS >= $curJ)) {
            $curN = $curS;
        } else {
            $curN = $curA;
        }
        $pdf->SetLeftMargin(20);
        $pdf->SetLineWidth(1);
        $pdf->Line($xAwal, $yAwal, $xAwal, $curN);
        $pdf->Line($xAwal + 20, $yAwal, $xAwal + 20, $curN);
        $pdf->Line($xAwal + 100, $yAwal, $xAwal + 100, $curN);
        $pdf->Line($xAwal + 220, $yAwal, $xAwal + 220, $curN);
        $pdf->Line($xAwal + 350, $yAwal, $xAwal + 350, $curN);
        $pdf->Line($xAwal + 500, $yAwal, $xAwal + 500, $curN);
        $pdf->Line($xAwal + 600, $yAwal, $xAwal + 600, $curN);
        $pdf->Line($xAwal + 750, $yAwal, $xAwal + 750, $curN);
        $pdf->Line($xAwal + 800, $yAwal, $xAwal + 800, $curN);
        $pdf->Line($xAwal, $curN, $xAwal + 800, $curN);
        if ($curN >= 500) {
            $pdf->AddPage();
            $pdf->SetLeftMargin(20);
            $pdf->SetRightMargin(20);
            $curY = 40;
            $yAwal = 40;
        } else {
            $curY = $curN;
        }
        $pdf->Ln();
    }
} else {
    $pdf->Ln();
    $pdf->MultiCell(800, 20, "Maaf Data Masih Kosong !", 1, 'C');
}

$pdf->Output('Rekapitulasi-Data-Guru-' . date('dFY') . '.pdf', 'I');
