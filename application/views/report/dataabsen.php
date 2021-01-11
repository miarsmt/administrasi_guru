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

date_default_timezone_set("Asia/Jakarta");

$pdf = new Coba('L', 'pt', 'A4');
$pdf->SetTitle('Laporan Rekapitulasi Absensi Siswa');
$pdf->AliasNbPages();
$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->SetAutoPageBreak(true, 50);

$pdf->AddPage();
$pdf->Image('./assets/img/logo.png', 250, 20, 50);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(70);
$pdf->Cell(0, 10, 'SEKOLAH MENENGAH KEJURUAN', 2, 0, 'C');
$pdf->Ln(14);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(70);
$pdf->Cell(0, 10, 'S M K  P A S I M  P L U S  S U K A B U M I', 0, 0, 'C');
$pdf->Ln(14);
$pdf->Cell(70);
$pdf->SetFont('helvetica', 'I', 9);
$pdf->Cell(0, 10, 'Graha Pasim Jalan Prana No. 8A Cikole Kota Sukabumi Telp. (0266) 241000', 0, 0, 'C');
$pdf->SetLineWidth(1);
$pdf->Line(20, 77, 820, 77);
$pdf->SetLineWidth(1, 5);
$pdf->Line(20, 79, 820, 79);

$pdf->SetY(110);
$pdf->SetFont('helvetica', 'BU', 13);
$pdf->Cell(0, 10, $title, 0, 0, 'C');
$pdf->Ln(25);

$pdf->Ln();
$nilaiY = $pdf->GetY();
$pdf->SetX(240);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(30, 20, 'Kelas', 0, 0, "C");
$pdf->Cell(60, 20, ':', 0, 0, "C");
$pdf->Cell(12, 20, $kelas['kelas'] . " " . $kelas['namakelas'], 0, 0, "C");
$pdf->Ln();
$nilaiY = $pdf->GetY();

$pdf->SetX(250);
$pdf->Cell(30, 20, 'Semester', 0, 0, "C");
$pdf->Cell(40, 20, ':', 0, 0, "C");
$pdf->Cell(10, 20, $semester, 0, 0, "C");
$pdf->Ln();
$nilaiY = $pdf->GetY();

$pdf->SetX(240);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLineWidth(1, 5);
$pdf->SetFillColor(0, 191, 255);
$pdf->Cell(20, 15, "No", 1, "LR", "C", true);
$pdf->Cell(80, 15, "NIS", 1, "LR", "C", true);
$pdf->Cell(130, 15, "Nama Siswa", 1, "LR", "C", true);
$pdf->Cell(50, 15, "Sakit", 1, "LR", "C", true);
$pdf->Cell(50, 15, "Ijin", 1, "LR", "C", true);
$pdf->Cell(50, 15, "Alpha", 1, "LR", "C", true);

$pdf->Ln();
if (!empty($absen)) {
    $no = 0;
    $nilaiY = $pdf->GetY();
    foreach ($absen as $key) {

        $no++;
        $pdf->SetX(240);
        $pdf->SetFont('helvetica', '', 9);
        $pdf->Cell(20, 15, $no . ".", 1, "LR", "C");
        $pdf->Cell(80, 15, $key->nis, 1, "LR", "C");
        $pdf->Cell(130, 15, $key->namasiswa, 1, "LR", "L");
        $pdf->Cell(50, 15, $key->sakit, 1, "LR", "C");
        $pdf->Cell(50, 15, $key->ijin, 1, "LR", "C");
        $pdf->Cell(50, 15, $key->alpha, 1, "LR", "C");
        $pdf->Ln();
        $nilaiY = $pdf->GetY();
    }
} else {
    $pdf->SetX(240);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(380, 20, "Maaf Data Masih Kosong !", 1, "LR", "C");
    $pdf->Ln();
    $nilaiY = $pdf->GetY();
}

$pdf->Output('Rekap-Absensi-' . date('dFY') . '.pdf', 'I');
