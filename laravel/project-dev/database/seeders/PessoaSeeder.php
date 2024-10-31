<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();
            Pessoa::create([
                'nome' => 'Renato Nunes',
                'email' => 'renato92@gmail.com',
            ]);

            $pessoa = Pessoa::factory()->make();
            Pessoa::create($pessoa->toArray());
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
        }

    }
}
