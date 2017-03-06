<?php

require_once '../fpdf/fpdf.php';
require_once '../conexion.php';

//$fecha_inicio = $_GET['ini'];
//$fecha_fin = $_GET['fin'];
$rif = $_GET['rif'];

$fecha_inicio = date_format(new DateTime($_GET['ini']), 'Y-m-d');
$fecha_fin = date_format(new DateTime($_GET['fin']), 'Y-m-d');

class PDF extends FPDF{

// Cabecera de página
function Header(){
    // Logo
    //$this->Image('../images/ic_launcher.png',10,8,30);
    $this->Image('../images/IconUPY3.png',15,12,35);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    //Atributos de Cell (Ubicacion horizontal, ubicacion vertical, contenido, borde, funcion, alinear
    $this->Cell(20,10,'Reporte de Rutas',0,0,'C');
    $this->Ln();
    //Buscamos el nombre de la empresa
    $sql = "SELECT nombre FROM empresa WHERE rif='".$GLOBALS['rif']."'";
    $nombre_empresa = mysqli_query($GLOBALS['conexion_bd'], $sql);
    foreach ($nombre_empresa as $ne){
    $this->Cell(180,10,'Empresa: '.$ne['nombre'],0,0,'C');
    $this->Ln();
    }
    if($GLOBALS['fecha_inicio']!=$GLOBALS['fecha_fin']){
        $this->Cell(180,10,'Entre fechas',0,0,'C');
        $this->Ln();
        $this->Cell(180,10,date_format(new DateTime($GLOBALS['fecha_inicio']), 'd-m-Y').' - '.date_format(new DateTime($GLOBALS['fecha_fin']), 'd-m-Y'),0,0,'C');
    }else{
        $this->Cell(180,10,utf8_decode('del día'),0,0,'C');
        $this->Ln();
        $this->Cell(180,10,date_format(new DateTime($GLOBALS['fecha_inicio']), 'd-m-Y'),0,0,'C');
    }
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}

function y_mayor($y2, $y3){
    if($y2 > $y3){
        return $y2;
    }else{
        return $y3;
    }
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$sql = "SELECT DISTINCT ruta.*,parada.hora,chofer.nombre as nombre_c, chofer.apellido as apellido_c FROM ruta "
     . "INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id "
     . "INNER JOIN parada ON parada.id = parada_ruta.id_parada "
     . "INNER JOIN cliente ON cliente.cedula = parada.id_cliente "
     . "INNER JOIN vehiculo ON ruta.id_vehiculo = vehiculo.placa "
     . "INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula "
     . "WHERE cliente.rif_empresa = '$rif' AND "
     . "ruta.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'";
$consulta = mysqli_query($conexion_bd, $sql);

if(mysqli_num_rows($consulta) > 0){
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $y2 = $y;
    $pdf->SetFillColor(153, 204, 255);
    $pdf->MultiCell(20,10,"Ruta",0, "C", "true");
    $x= $x + 20;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(24,10,"Fecha",0, "C", "true");
    $x= $x + 24;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(24,10,"Hora",0, "C", "true");
    $x= $x + 24;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(50,10,"Conductor",0, "C", "true");
    $x= $x + 50;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(25,10,"Tipo / Costo / Precio",0, "C", "true");
    $x= $x + 25;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(50,10,"Empleados",0, "C", "true");
    $x= $x + 50;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->Ln();
    
    $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
    $bandera = false; //Para alternar el relleno
    foreach ($consulta as $c){
        $pdf->SetY($y2);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->MultiCell(20,10,utf8_decode($c['id']),0, "C", $bandera);
        $x= $x + 20;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(24,10,date_format(new DateTime($c['fecha']), 'd-m-Y'),0, "C", $bandera);
        $x= $x + 24;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(24,10,date_format(new DateTime($c['hora']), 'h:i:s a'),0, "C", $bandera);
        $x= $x + 24;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(50,10,utf8_decode($c['nombre_c']).' '.utf8_decode($c['apellido_c']),0, "C", $bandera);
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        
        $sql = "SELECT descripcion FROM tipo_ruta "
            . "WHERE id = '".$c['id_tipo_ruta']."'";
        $consulta_tipo = mysqli_query($conexion_bd, $sql);

        if(mysqli_num_rows($consulta_tipo) > 0){
         foreach ($consulta_tipo as $ct){
             $tipo = utf8_decode($ct['descripcion']). "\n";
         }
        }else{
            $tipo = "Sin asignar";
        }
        $pdf->MultiCell(25,10,$tipo.$c['costo'].' '.$c['precio'],0, "C", $bandera);
        $x= $x + 25;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        
        $emp = "";
        $sql = "SELECT cliente.cedula, cliente.nombre, cliente.apellido FROM ruta "
            . "INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id "
            . "INNER JOIN parada ON parada.id = parada_ruta.id_parada "
            . "INNER JOIN cliente ON cliente.cedula = parada.id_cliente "
            . "WHERE ruta.id = '".$c['id']."'";
        $consulta_emple = mysqli_query($conexion_bd, $sql);

        if(mysqli_num_rows($consulta_emple) > 0){
         foreach ($consulta_emple as $ce){
             $emp .= $ce['cedula']. " ". $ce['nombre']. " ". $ce['apellido']. "\n";
         }
        }
        
        $pdf->MultiCell(50,10,utf8_decode($emp),0, "C", $bandera);
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $bandera = !$bandera;//Alterna el valor de la bandera
    }
    
}else{
    $pdf->Cell(0,10, utf8_decode('No existen datos para mostrar'),0,1);
}

mysqli_close($conexion_bd);
$pdf->Output();