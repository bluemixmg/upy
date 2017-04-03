<?php

require_once '../fpdf/fpdf.php';
require_once '../conexion.php';

$fecha_inicio = $_GET['ini'];
$fecha_fin = $_GET['fin'];
$cedula = $_GET['cedula'];

class PDF extends FPDF{
// Cabecera de página
function Header(){
    // Logo
    $this->Image('../images/IconUPY3.png',15,12,35);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(20,10,'Reporte de Costos',0,0,'C');
    $this->Ln();
    //Buscamos el nombre de la empresa
    $sql = "SELECT nombre,apellido FROM chofer WHERE id_cedula='".$GLOBALS['cedula']."'";
    $nombre_chofer = pg_fetch_all(pg_query($GLOBALS['conexion_bd'], $sql));
    foreach ($nombre_chofer as $nc){
    $this->Cell(180,10,'Conductor: '.$nc['nombre'].' '.$nc['apellido'],0,0,'C');
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

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Times','',12);
$sql = "SELECT COUNT(ruta.id_vehiculo) as nro_r, vehiculo.placa, CONCAT (chofer.id_usuario, ' - ',chofer.nombre, ' ',  chofer.apellido) as cho, sum(ruta.costo) as total FROM ruta 
    INNER JOIN vehiculo ON ruta.id_vehiculo = vehiculo.placa
    INNER JOIN chofer ON chofer.id_cedula = vehiculo.id_chofer
    WHERE ruta.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND chofer.id_cedula='".$cedula."'";
$consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
if(pg_num_rows($consulta)>0){
    $pdf->Ln();
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $y2 = $y;

    $pdf->SetFillColor(153, 204, 255);
    $pdf->MultiCell(50,10,"Conductor",0, "C", "true");
    $x= $x + 50;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(50,10,utf8_decode("Vehículo"),0, "C", "true");
    $x= $x + 50;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(40,10,"Cantidad de rutas",0, "C", "true");
    $x= $x + 40;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(50,10,"Costo Total",0, "C", "true");
    $x= $x + 50;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->Ln();
    
    $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
    $bandera = false; //Para alternar el relleno
    
    // pagina totales
    foreach ($consulta as $c){
        $placa = $c['placa'];
        $pdf->SetY($y2);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        if ($y >= 265) {
            $pdf->AddPage();
            $pdf->SetY(40); // should be your top margin
            $y = 40;
            $y2 = 40;
        }
        
        $pdf->MultiCell(50,10,utf8_decode($c['cho']),0, "C", $bandera);
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(50,10,utf8_decode($c['placa']),0, "C", $bandera);
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(40,10,utf8_decode($c['nro_r']),0, "C", $bandera);
        $x= $x + 40;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(50,10,utf8_decode($c['total']),0, "C", $bandera);
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
        $pdf->MultiCell(180,10,utf8_decode("Los costos pueden variar debido a rutas sin tipo de ruta asignada."),0, "C");
        break;
    }
    $pdf->AddPage();
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $y2 = $y;
    // detallado -------------------------------------------------------------------------
    $sql2 = "SELECT ruta.id, empresa.nombre, tipo_ruta.descripcion, ruta.costo, ruta.fecha, parada.hora FROM ruta 
        INNER JOIN tipo_ruta ON tipo_ruta.id = ruta.id_tipo_ruta 
        INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id 
        INNER JOIN parada ON parada.id = parada_ruta.id_parada 
        INNER JOIN cliente ON cliente.cedula = parada.id_cliente 
        INNER JOIN empresa ON empresa.rif = cliente.rif_empresa 
    WHERE ruta.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND ruta.id_vehiculo='".$placa."'";
    $consulta2 = pg_fetch_all(pg_query($conexion_bd, $sql2));
    if(pg_num_rows($consulta2)>0){
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $y2 = $y;

        $pdf->SetFillColor(153, 204, 255);
        $pdf->MultiCell(20,10,"Ruta",0, "C", "true");
        $x= $x + 20;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(50,10,"Empresa",0, "C", "true");
        $x= $x + 50;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(30,10,"Tipo ruta",0, "C", "true");
        $x= $x + 30;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(40,10,"Costo",0, "C", "true");
        $x= $x + 40;
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
        $pdf->Ln();

        $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $bandera = false; //Para alternar el relleno

        // pagina totales
        foreach ($consulta2 as $c2){
            $pdf->SetY($y2);
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            if ($y >= 265) {
                $pdf->AddPage();
                $pdf->SetY(40); // should be your top margin
                $y = 40;
                $y2 = 40;
            }

            $pdf->MultiCell(20,10,utf8_decode($c2['id']),0, "C", $bandera);
            $x= $x + 20;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(50,10,utf8_decode($c2['nombre']),0, "C", $bandera);
            $x= $x + 50;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(30,10,utf8_decode($c2['descripcion']),0, "C", $bandera);
            $x= $x + 30;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(40,10,utf8_decode($c2['costo']),0, "C", $bandera);
            $x= $x + 40;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(24,10,date_format(new DateTime($c2['fecha']), 'd-m-Y'),0, "C", $bandera);
            $x= $x + 24;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(24,10,date_format(new DateTime($c2['hora']), 'h:i:s a'),0, "C", $bandera);
            $x= $x + 24;
            $y2 = $pdf->y_mayor($y2,$pdf->GetY());
            $pdf->SetXY($x, $y);
            $pdf->Ln();
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }
}else{
    $pdf->Cell(0,10, utf8_decode('No existen datos para mostrar'),0,1);
}

pg_close($conexion_bd);
$pdf->Output();