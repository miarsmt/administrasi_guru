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
$pdf->SetTitle('Laporan Rekapitulasi Kelas');
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
$pdf->SetX(160);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(30, 20, 'Kelas', 0, 0, "C");
$pdf->Cell(10, 20, ':', 0, 0, "C");
$pdf->Cell(40, 20, $tingkat, 0, 0, "C");
$pdf->Ln();
$nilaiY = $pdf->GetY();

$pdf->SetX(160);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLineWidth(1, 5);
$pdf->SetFillColor(0, 191, 255);
$pdf->Cell(20, 15, "No", 1, "LR", "C", true);
$pdf->Cell(80, 15, "ID Kelas", 1, "LR", "C", true);
$pdf->Cell(100, 15, "Nama Kelas", 1, "LR", "C", true);
$pdf->Cell(80, 15, "Angkatan", 1, "LR", "C", true);
$pdf->Cell(170, 15, "Jurusan", 1, "LR", "C", true);
$pdf->Cell(80, 15, "Status", 1, "LR", "C", true);

$pdf->Ln();
if (!empty($kelas)) {
    $no = 0;
    $nilaiY = $pdf->GetY();
    foreach ($kelas as $key) {
        if ($key->is_active == 1) {
            $active = 'Aktif';
        } else {
            $active = 'Tidak Aktif';
        }

        $no++;
        $pdf->SetX(160);
        $pdf->SetFont('helvetica', '', 9);
        $pdf->Cell(20, 15, $no . ".", 1, "LR", "C");
        $pdf->Cell(80, 15, $key->kodekelas, 1, "LR", "L");
        $pdf->Cell(100, 15, $key->kelas . " " . $key->namakelas, 1, "LR", "L");
        $pdf->Cell(80, 15, $key->angkatankelas, 1, "LR", "C");
        $pdf->Cell(170, 15, $key->namajurusan, 1, "LR", "L");
        $pdf->Cell(80, 15, $active, 1, "LR", "C");
        $pdf->Ln();
        $nilaiY = $pdf->GetY();
    }
} else {
    $pdf->SetX(160);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(530, 20, "Maaf Data Masih Kosong !", 1, "LR", "C");
    $pdf->Ln();
    $nilaiY = $pdf->GetY();
}

$pdf->Output('Rekap-Kelas-' . date('dFY') . '.pdf', 'I');
