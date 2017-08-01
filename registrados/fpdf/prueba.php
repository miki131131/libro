<?php
include('../conexion.php');
    require('fpdf.php');

    class PDF extends FPDF {
        // Cabecera de página
        function Header() {
            // Logo
            //$this->Image('tv.jpg',10,8,33);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            //$this->Cell(0,10,'Universal Sports Inc.',0,0,'L');
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de página
        function Footer() {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }	

    $border=0;

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    //$pdf->Cell(0,40,utf8_decode('Factura Nº 30145'),$border,1,'L');
   // $pdf->Cell(105,10,utf8_decode('Producto'),$border,0,'L');
    //$pdf->Cell(30,10,'Unidades',$border,0,'L');
    //$pdf->Cell(40,10,'Precio',$border,1,'L');
$valor = $_GET['valor'];
 $sql = "SELECT us.idUser, us.nombreCompleto, me.idUser, me.fecha, me.idMensaje, me.mensaje FROM mensajes as me INNER JOIN usuarios as us on me.idUser=us.idUser WHERE me.idMensaje='$valor'";
  $res = $conn->query($sql);

     foreach($res as $row){
       // $pdf->Cell(105,10,utf8_decode('Producto' . $contador),$border,0,'L');
        $pdf->Cell(5,10,utf8_decode('Comentarios de ' .$row['nombreCompleto']),$border,0,'L')."\n";
        $pdf->MultiCell(0,25,utf8_decode('Dice : ' . $row['mensaje']));
			
		
		$pdf->Cell(5,50,utf8_decode('El día' . $row['fecha']),$border,1,'L');	
		
    }

    $pdf->Output();
?>