<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Producto;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    use Importable;
    private $categorias;
    private $medidas;

    public function __construct()
    {
        $this->categorias = Categoria::pluck('id', 'nombre_categoria');
        $this->medidas = Medida::pluck('id', 'nombre_medida');
    }

    public function model(array $row)
    {

        //     $medi = Medida::all();
        //    if($medi->nombre_medida !=$row['medida']){
        //     Medida::insert($row['medida']);
        //    }

        return new Producto([
            // 'foto' => $row['foto'],
            'num_orden' => $row['numero_de_orden'],
            'nombre_pr' => $row['nombre_producto'],
            'desc_pr' => $row['observacion'],
            'stock' => $row['stock'],
            'inicial' => $row['stock'],
            'medida_id' => $this->medidas[$row['medida']],
            'categoria_id' => $this->categorias[$row['categoria']]
        ]);
    }
    public function rules(): array
    {
        return [
            '*.numero_de_orden' => [
                'integer',
                'required',
                'unique:productos,num_orden'
            ],
            '*.nombre_producto' => [
                'string',
                'required',
                'unique:productos,nombre_pr'
            ],
            '*.observacion' => [
                'string',
                'nullable'
            ],
            '*.stock' => [
                'integer',
                'required'
            ],
            '*.medida' => [
                'required',
                Rule::exists('medidas', 'nombre_medida')
            ],
            '*.categoria' => [
                'required',
                Rule::exists('categorias', 'nombre_categoria')
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.numero_de_orden.unique' => 'Ya existe un producto con el mismo número de orden.',
            '*.nombre_producto.unique' => 'Ya existe un producto con el mismo nombre.',
            '*.medida.exists' => 'La medida ingresada no existe.',
            '*.categoria.exists' => 'La categoría ingresada no existe.',
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
