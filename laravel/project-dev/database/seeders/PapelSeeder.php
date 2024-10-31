<?php

namespace Database\Seeders;

use App\Models\Papel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();
            Papel::create([
                'nome' => 'Vendedor',
                'gestor' => 'N',
            ]);

            $papel = Papel::factory()->make();
            Papel::create($papel->toArray());
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
        }
    }
}
