<?php

namespace App\Imports;

use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SalidasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    private $productos;
    // private $medidas;

    public function __construct()
    {
        $this->productos = Producto::pluck('id', 'nombre_pr');
        // $this->medidas = Medida::pluck('id', 'nombre_medida');
    }
    
    public function model(array $row)
    {
        return new Salida([
            'producto_id' => $this->productos[$row['producto']],
            'obs_salida' => $row['observacion'],
            'cant_salida' => $row['cantidad_salida'],
            'fecha_salida' => $row['fecha'],
            'contador_salida' => 0,
        ]);
    }
    public function rules(): array
    {
        return [
            'producto' => [
                'required',
                Rule::exists('productos', 'nombre_pr')
            ],
            'cantidad_salida' => [
                'required',
                'integer',
                'min:1'
            ],
            'fecha' => [
                'required',
                'date:Y-m-d'
            ],
            'observacion' => [
                'nullable',
                'string'
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'producto.required' => 'El campo producto es requerido.',
            'producto.exists' => 'El producto ingresado no existe.',
            'cantidad_salida.required' => 'El campo cantidad es requerido.',
            'cantidad_salida.integer' => 'El campo cantidad debe ser un número entero.',
            'cantidad_salida.min' => 'La cantidad debe ser mayor a 0.',
            'fecha.required' => 'El campo fecha es requerido.',
            'fecha.date' => 'La fecha debe tener el formato: Y-m-d.',
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
