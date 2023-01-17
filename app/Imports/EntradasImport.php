<?php

namespace App\Imports;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class EntradasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    use Importable;
    private $productos;
    // private $medidas;

    public function __construct()
    {
        $this->productos = Producto::pluck('id', 'nombre_pr');
    }
    public function model(array $row)
    {
        $stock = Producto::find($this->productos[$row['producto']]);
        $stock->stock = $stock->stock + $row['cantidad'];
        $stock->save();
        return new Entrada([
            'producto_id' => $this->productos[$row['producto']],
            'cant_entrada_val' => $row['cantidad'],
            'fecha_entrada' => $row['fecha'],
            'obs_entrada' => $row['observacion'],

        ]);
    }
    public function rules(): array
    {
        return [
            'producto' => [
                'required',
                Rule::exists('productos', 'nombre_pr')
            ],
            'cantidad' => [
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
            'cantidad.required' => 'El campo cantidad es requerido.',
            'cantidad.integer' => 'El campo cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser mayor a 0.',
            'fecha.required' => 'El campo fecha es requerido.',
            'fecha.date' => 'La fecha debe tener el formato: Y-m-d.',
        ];
    }
    public function batchSize(): int
    {
        return 4000;
    }
    public function chunkSize(): int
    {
        return 4000;
    }
}
