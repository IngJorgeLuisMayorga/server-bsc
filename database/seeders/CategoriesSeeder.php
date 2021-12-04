<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// 'SKIN' | 'MAIN_INGREDIENT' | 'SOLUTION' | 'STEP' | 'EXTRA'

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        error_log('[SEEDING] [CATEGORIES] -> START ');

        // SKINS
            $skins_names = [
                'Apto para piel sensible', 'Apto para piel seca', 'Apto para piel mixta', 'Apto para piel grasa',
                'Apto para piel madura', 'Apto para todo tipo piel', 'Producto Capilar'
            ];
            foreach($skins_names  as $name) {
                DB::table('categories')->insert([
                    'type' => 'SKIN',
                    'name' => $name,
                    'picture_normal' => '/images/categories/piel sensible 1.png',
                    'picture_hover' => '/images/categories/piel sensible 2.png',
                    'updated_at' =>  date("Y-m-d H:i:s"),
                    'created_at' =>  date("Y-m-d H:i:s"),
                ]);
            }


            // MAIN INGREDIENTS
            $skins_main_ingredients = [
                'Centella asiática', 'Accesorio', 'Accesorio', 'Arroz negro fermentado', 'Acido hialuronico', 'Peptidos', 'Colageno',
                'Mucina de caracol', 'Rosa bulgaria', 'Pantenol','Niacinamida', 'AHA', 'BHA', 'PHA', 'AHA-BHA-PHA', 'Gaactomyces',
                'Te verde', 'Limon', 'Yuja', 'Carbon activado', 'Aloe vera', 'Vitamina C', 'Ceramidas','Sandia','Miel','Choco menta',
                'Arándanos', 'Manzana','verde','Berry','Espino amarillo','Higo', 'Algas marinas', 'Arcilla','Proteína de leche',
                'Artemisa', 'Matcha', 'Quinoa', 'Camelia','Tipo tone up', 'Pera', 'Propóleos','Granada'
            ];
            foreach($skins_main_ingredients  as $main_ingredients) {
                DB::table('categories')->insert([
                    'type' => 'MAIN_INGREDIENT',
                    'name' => $main_ingredients,
                    'picture_normal' => '/images/categories/iluminador 1.png',
                    'picture_hover' => '/images/categories/iluminador 2.png',
                    'updated_at' =>  date("Y-m-d H:i:s"),
                    'created_at' =>  date("Y-m-d H:i:s"),
                ]);
            }

            // SOLUTIONS
            $skins_solutions = [
                'Producto anti edad',
                'Producto antioxidante',
                'Producto iluminador',
                'Producto balanceante',
                'Producto regenerador',
                'Producto hidratante',
                'Producto para acné',
                'Producto para poros',
                'Producto para pigmentación',
                'Producto para contaminación',
                'Producto protector',
                'Producto para piel irritada',
                'Producto para piel rojez',
                'Producto para ojeras',
                'Producto para puntos negros',
                'Producto para textura',
                'Producto para textura',
            ];
            foreach($skins_solutions as $solution) {
                DB::table('categories')->insert([
                    'type' => 'SOLUTION',
                    'name' => $solution,
                    'picture_normal' => '/images/categories/antioxidante 1.png',
                    'picture_hover' => '/images/categories/antioxidante 2.png',
                    'updated_at' =>  date("Y-m-d H:i:s"),
                    'created_at' =>  date("Y-m-d H:i:s"),
                ]);
            }


        // STEP
        $steps = [
            'Limpiador acuoso',
            'Exfoliante',
            'Tónico',
            'Esencia',
            'Serum',
            'Contorno de ojos',
            'Mascarilla',
            'Hidratante',
            'Protector',
            'solar',
            'Shampoo',
            'Acondicionador',
            'Tratamiento capilar',
            'Esencia capilar',
            'Aceite humectante',
            'Aceite capilar',
            'Maquillaje de labios',
            'Maquillaje de piel',
            'Banda de pelo',
            'Cepillo de limpieza',
            'Parches hidrocoloides',
            'Tratamiento localizado',
        ];
        foreach($steps as $step) {
            DB::table('categories')->insert([
                'type' => 'STEP',
                'name' => $step,
                'picture_normal' => '/images/categories/pigmentacion 1.png',
                'picture_hover' => '/images/categories/pigmentacion 2.png',
                'updated_at' =>  date("Y-m-d H:i:s"),
                'created_at' =>  date("Y-m-d H:i:s"),
            ]);
        }

        // EXTRA
        $extras = [
            'Crulety',
            'Producto vegano',
        ];
        foreach($extras as $extra) {
            DB::table('categories')->insert([
                'type' => 'EXTRA',
                'name' => $extra,
                'picture_normal' => '/images/categories/pigmentacion 1.png',
                'picture_hover' => '/images/categories/pigmentacion 2.png',
                'updated_at' =>  date("Y-m-d H:i:s"),
                'created_at' =>  date("Y-m-d H:i:s"),
            ]);
        }
        error_log('[SEEDING] [CATEGORIES] -> DONE ');
    }
}
