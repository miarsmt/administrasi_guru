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
$pdf->SetTitle('Laporan Rekapitulasi Agenda Kegiatan');
$pdf->AliasNbPages();
$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(60);
$pdf->SetRightMargin(60);
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

$pdf->SetLeftMargin(60);
$pdf->Ln(15);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 10, 'NIP', 0, 0, 'L');
$pdf->Cell(10, 10, ':', 0, 0, 'L');
$pdf->Cell(150, 10, $guru['nip'], 0, 0, 'L');
$pdf->Ln(15);
$pdf->Cell(60, 10, 'Nama Guru', 0, 0, 'L');
$pdf->Cell(10, 10, ':', 0, 0, 'L');
$pdf->Cell(150, 10, $guru['namaguru'], 0, 0, 'L');
$pdf->Ln(15);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLineWidth(1, 5);
$pdf->SetFillColor(0, 191, 255);
$pdf->Cell(20, 15, "No", 1, "LR", "C", true);
$pdf->Cell(100, 15, "Tanggal", 1, "LR", "C", true);
$pdf->Cell(50, 15, "Jam Ke", 1, "LR", "C", true);
$pdf->Cell(80, 15, "Kelas", 1, "LR", "C", true);
$pdf->Cell(170, 15, "Mata Pelajaran", 1, "LR", "C", true);
$pdf->Cell(200, 15, "Uraian Kegiatan", 1, "LR", "C", true);
$pdf->Cell(100, 15, "Keterangan", 1, "LR", "C", true);
if (!empty($agenda)) {
    $pdf->SetLeftMargin(60);
    $pdf->Ln();
    $no = 0;
    $curY = $pdf->GetY();
    $curN = 0;
    $akhir = 0;
    foreach ($agenda as $key) {

        $no++;
        $yAwal = $pdf->GetY();
        $xAwal = $pdf->GetX();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->Cell(20, 15, $no . ".", 'LRT', 0, "C");
        $pdf->SetXY($pdf->GetX(), $curY);
        $pdf->MultiCell(100, 15, format_indo($key->tanggal), 'LRT', 'C');
        $pdf->SetXY($pdf->GetX() + 120, $curY);
        $pdf->MultiCell(50, 15, $key->jam_ke, 'LRT', 'C');
        $pdf->SetXY($pdf->GetX() + 170, $curY);
        $pdf->MultiCell(80, 15, $key->kelas . " " . $key->namakelas, 'LRT', 'L');
        $curA = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 250, $curY);
        $pdf->MultiCell(170, 15, $key->namamapel, 'lRT', "L");
        $curJ = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 420, $curY);
        $pdf->MultiCell(200, 15, $key->kodekd . " " . $key->namakd, 'LRT', "L");
        $curS = $pdf->GetY();
        $pdf->SetXY($pdf->GetX() + 620, $curY);
        $pdf->MultiCell(100, 15, $key->keterangan, 'LRT', "L");
        if (($curA >= $curJ) && ($curA >= $curS)) {
            $curN = $curA;
        } else if (($curJ >= $curA) && ($curJ >= $curS)) {
            $curN = $curJ;
        } else if (($curS >= $curA) && ($curS >= $curJ)) {
            $curN = $curS;
        } else {
            $curN = $curA;
        }
        $pdf->SetLeftMargin(60);
        $pdf->SetLineWidth(1);
        $pdf->Line($xAwal, $yAwal, $xAwal, $curN);
        $pdf->Line($xAwal + 20, $yAwal, $xAwal + 20, $curN);
        $pdf->Line($xAwal + 120, $yAwal, $xAwal + 120, $curN);
        $pdf->Line($xAwal + 170, $yAwal, $xAwal + 170, $curN);
        $pdf->Line($xAwal + 250, $yAwal, $xAwal + 250, $curN);
        $pdf->Line($xAwal + 420, $yAwal, $xAwal + 420, $curN);
        $pdf->Line($xAwal + 620, $yAwal, $xAwal + 620, $curN);
        $pdf->Line($xAwal + 720, $yAwal, $xAwal + 720, $curN);
        $pdf->Line($xAwal, $curN, $xAwal + 720, $curN);
        if ($curN >= 500) {
            $pdf->AddPage();
            $pdf->SetLeftMargin(60);
            $pdf->SetRightMargin(60);
            $curY = 40;
            $yAwal = 40;
        } else {
            $curY = $curN;
        }
        $pdf->Ln();
    }
} else {
    $pdf->Ln();
    $pdf->MultiCell(720, 20, "Maaf Data Masih Kosong !", 1, 'C');
}

$pdf->Output('Rekapitulasi-Agenda-Kegiatan-' . date('dFY') . '.pdf', 'I');
