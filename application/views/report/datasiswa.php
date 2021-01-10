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
$pdf->SetTitle('Laporan Rekapitulasi Siswa');
$pdf->AliasNbPages();
$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(45);
$pdf->SetRightMargin(45);
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

$pdf->Ln();
$nilaiY = $pdf->GetY();
$pdf->SetX(45);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(30, 20, 'Kelas', 0, 0, "C");
$pdf->Cell(10, 20, ':', 0, 0, "C");
$pdf->Cell(40, 20, $kelas['kelas'] . " " . $kelas['namakelas'], 0, 0, "C");
$pdf->Ln();
$nilaiY = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLineWidth(1, 5);
$pdf->SetFillColor(0, 191, 255);
$pdf->Cell(20, 15, "No", 1, "LR", "C", true);
$pdf->Cell(100, 15, "NIS", 1, "LR", "C", true);
$pdf->Cell(150, 15, "Nama Siswa", 1, "LR", "C", true);
$pdf->Cell(150, 15, "Tempat, Tanggal Lahir", 1, "LR", "C", true);
$pdf->Cell(150, 15, "Alamat", 1, "LR", "C", true);
$pdf->Cell(100, 15, "Asal Sekolah", 1, "LR", "C", true);
$pdf->Cell(80, 15, "Semester Aktif", 1, "LR", "C", true);
if (!empty($siswa)) {
    $pdf->SetLeftMargin(45);
    $pdf->Ln();
    $no = 0;
    $curY = $pdf->GetY();
    $curN = 0;
    $akhir = 0;
    foreach ($siswa as $sw) {


        $no++;
        $yAwal = $pdf->GetY();
        $xAwal = $pdf->GetX();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->Cell(20, 15, $no . ".", 'LRT', 0, "C");
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->MultiCell(100, 15, $sw->nis, 'LRT', 'C');
        $pdf->SetXY($pdf->GetX() + 120, $curY);
        $pdf->MultiCell(150, 15, $sw->namasiswa, 'LRT', 'L');
        $pdf->SetXY($pdf->GetX() + 270, $curY);
        $pdf->MultiCell(150, 15, $sw->tempatlahir . " \n" . $sw->tgllahir, 'LRT', 'L');
        $curA = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 420, $curY);
        $pdf->MultiCell(150, 15, $sw->alamatsiswa, 'lRT', "L");
        $curJ = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 570, $curY);
        $pdf->MultiCell(100, 15, $sw->asalsekolah, 'LRT', "L");
        $curS = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 670, $curY);
        $pdf->MultiCell(80, 15, $sw->semester_aktif, 'LRT', "C");
        if (($curA >= $curJ) && ($curA >= $curS)) {
            $curN = $curA;
        } else if (($curJ >= $curA) && ($curJ >= $curS)) {
            $curN = $curJ;
        } else if (($curS >= $curA) && ($curS >= $curJ)) {
            $curN = $curS;
        } else {
            $curN = $curA;
        }
        $pdf->SetLeftMargin(45);
        $pdf->SetLineWidth(1);
        $pdf->Line($xAwal, $yAwal, $xAwal, $curN);
        $pdf->Line($xAwal + 20, $yAwal, $xAwal + 20, $curN);
        $pdf->Line($xAwal + 120, $yAwal, $xAwal + 120, $curN);
        $pdf->Line($xAwal + 270, $yAwal, $xAwal + 270, $curN);
        $pdf->Line($xAwal + 420, $yAwal, $xAwal + 420, $curN);
        $pdf->Line($xAwal + 570, $yAwal, $xAwal + 570, $curN);
        $pdf->Line($xAwal + 670, $yAwal, $xAwal + 670, $curN);
        $pdf->Line($xAwal + 750, $yAwal, $xAwal + 750, $curN);
        $pdf->Line($xAwal, $curN, $xAwal + 750, $curN);
        if ($curN >= 500) {
            $pdf->AddPage();
            $pdf->SetLeftMargin(45);
            $pdf->SetRightMargin(45);
            $curY = 40;
            $yAwal = 40;
        } else {
            $curY = $curN;
        }
        $pdf->Ln();
    }
} else {
    $pdf->Ln();
    $pdf->MultiCell(750, 20, "Maaf Data Masih Kosong !", 1, 'C');
}

$pdf->Output('Rekapitulasi-Data-Siwa-' . date('dFY') . '.pdf', 'I');
