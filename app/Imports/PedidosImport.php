<?php

namespace App\Imports;

use App\Models\Pedido;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Semana;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PedidosImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, withvalidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $productos;
    private $medidas;
    private $semanas;

    public function __construct()
    {
        $this->productos = Producto::pluck('id', 'nombre_pr');
        $this->medidas = Medida::pluck('id', 'nombre_medida');
        $this->semanas = Semana::pluck('id', 'nombre_semana');
    }
    public function model(array $row)
    {
        return new Pedido([
            'producto_id' => $this->productos[$row['producto']],
            'medida_id' => $this->medidas[$row['medida']],
            'semana_id' => $this->semanas[$row['semana']],
            'primera_entrega' => $row['primera_entrega'],
            'segunda_entrega' => $row['segunda_entrega'],
            'total_entrega' => $row['total_entrega']
        ]);
    }
    public function rules(): array
    {
        return [
            'producto' => [
                'required',
                Rule::exists('productos', 'nombre_pr')
            ],
            'medida' => [
                'required',
                Rule::exists('medidas', 'nombre_medida')
            ],
            'semana' => [
                'required',
                Rule::exists('semanas', 'nombre_semana')
            ],
            'primera_entrega' => [
                'required',
                'integer',
                'min:1'
            ],
            'segunda_entrega' => [
                'required',
                'integer',
                'min:1'
            ],
            'total_entrega' => [
                'required',
                'integer',
                'min:1'
            ],

        ];
    }

    public function customValidationMessages()
    {
        return [
            'producto.required' => 'El campo producto es requerido.',
            'producto.exists' => 'El producto ingresado no existe.',
            'medida.required' => 'El campo medida es requerido.',
            'medida.exists' => 'La medida ingresada no existe.',
            'semana.required' => 'El campo semana es requerido.',
            'semana.exists' => 'La semana ingresada no existe.',
            'primera_entrega.required' => 'El campo primera_entrega es requerido.',
            'primera_entrega.integer' => 'El campo primera_entrega debe ser un número entero.',
            'primera_entrega.min' => 'La primera_entrega debe ser mayor a 0.',
            'segunda_entrega.required' => 'El campo segunda_entrega es requerido.',
            'segunda_entrega.integer' => 'El campo segunda_entrega debe ser un número entero.',
            'segunda_entrega.min' => 'La segunda_entrega debe ser mayor a 0.',
            'total_entrega.required' => 'El campo total_entrega es requerido.',
            'total_entrega.integer' => 'El campo total_entrega debe ser un número entero.',
            'total_entrega.min' => 'La total_entrega debe ser mayor a 0.',

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
