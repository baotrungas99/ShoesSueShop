<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'category_name' => $row[0],
            'slug_category_product' => $row[1],
            'meta_keywords' => $row[2],
            'category_description' => $row[3],
            'category_status' => $row[4],
        ]);
    }
}
