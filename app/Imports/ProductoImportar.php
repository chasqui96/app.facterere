<?php

namespace App\Imports;

use App\Modelos\Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductoImportar implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producto([
        "id_items"               => $row[0],
        "descripcion_items"      => $row[1],
        "costo_items"           => $row[2],
        "precio_minorista_items"  => $row[3],
        "precio_mayorista_items"  => $row[4],
        "codigode_barra_items"   => $row[5],
        "id_categoria"              => $row[6],
        "id_tipo_impuesto"          => $row[7],
        "id_desglosar"              => $row[8],
        "id_bloque"                 => $row[9],
        "estado_items"           => $row[10],
        ]);
    }
}
