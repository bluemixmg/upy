<?php

require_once '../fpdf/fpdf.php';
require_once '../conexion.php';$con = new Conexion();

$fecha_inicio = $_GET['ini'];
$fecha_fin = $_GET['fin'];

class PDF extends FPDF{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../images/IconUPY3.png',15,12,35);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    //Atributos de Cell (tamaño horizontal, tamaño vertical, contenido, borde, funcion, alinear
    $this->Cell(20,10,'Reporte de Incidencias',0,0,'C');
    $this->Ln();
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
function Footer()
{
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
$sql = "SELECT incidencia.*,chofer.id_usuario,chofer.nombre,chofer.apellido,chofer.telefono,vehiculo.modelo,tipo_incidencia.nombre as i_nombre FROM incidencia 
    INNER JOIN chofer ON chofer.id_usuario = incidencia.id_usuario
    INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer 
    INNER JOIN tipo_incidencia ON incidencia.id_tipo_incidencia = tipo_incidencia.id 
    WHERE fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'"
  . " ORDER BY incidencia.id";
$consulta = $con->consultar( $sql);
if($con->num_filas($consulta)>0){
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $y2 = $y;

    $pdf->SetFillColor(153, 204, 255);
    $pdf->MultiCell(20,10,"Nro",0, "C", "true");
    $x= $x + 20;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(35,10,"Incidencia",0, "C", "true");
    $x= $x + 35;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(40,10,"Conductor",0, "C", "true");
    $x= $x + 40;
    $y2 = $pdf->y_mayor($y2,$pdf->GetY());
    $pdf->SetXY($x, $y);
    $pdf->MultiCell(50,10,"Empleado / Empresa",0, "C", "true");
    $x= $x + 50;
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
    foreach ($consulta as $c){
        $pdf->SetY($y2);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        if ($y >= 265) {
            $pdf->AddPage();
            $pdf->SetY(50); // should be your top margin
            $y = 50;
            $y2 = 40;
        }
        
        $pdf->MultiCell(20,10,utf8_decode($c['id']),0, "C", $bandera);
        $x= $x + 20;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(35,10,utf8_decode($c['i_nombre']),0, "C", $bandera);
        $x= $x + 35;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(40,10,utf8_decode($c['nombre']).' '.utf8_decode($c['apellido']),0, "C", $bandera);
        $x= $x + 40;
        $y2 = $pdf->y_mayor($y2,$pdf->GetY());
        $pdf->SetXY($x, $y);
        if($c['id_cliente']==0){
            $pdf->MultiCell(50,10,'No aplica',0, "C", $bandera);
        }else{
            $sql = "SELECT cliente.nombre,cliente.apellido,empresa.nombre as empresa FROM cliente "
                 . "INNER JOIN empresa ON empresa.rif = cliente.rif_empresa "
                 . "WHERE cliente.cedula='".$c['id_cliente']."'";
            $consulta_cliente = $con->consultar( $sql);
            if($con->num_filas($consulta_cliente)>0){
                foreach ($consulta_cliente as $cc){
                    $pdf->MultiCell(50,10,utf8_decode($cc['nombre']).' '.$cc['apellido'].' / '.$cc['empresa'],0, "C", $bandera);
                    //echo '<td>RETRASO DEL PASAJERO<br>'.$cc['nombre'].' '.$cc['apellido'].'<br>'.$cc['empresa'].'</td>';
                }
            }else{
                $pdf->MultiCell(50,10,utf8_decode($c['id_cliente']),0, "C", $bandera);
            }
        }
        $x= $x + 50;
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
        
        $pdf->Ln();
        $bandera = !$bandera;//Alterna el valor de la bandera
    }
}else{
    $pdf->Cell(0,10, utf8_decode('No existen datos para mostrar'),0,1);
}

$con->cerrar_conexion();
$pdf->Output();