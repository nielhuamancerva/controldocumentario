<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(Users_AreasTableSeeder::class);
        $this->call(Roles_UserTableSeeder::class);
        $this->call(DocumentosTableSeeder::class);
        $this->call(CantidadEnvioTableSeeder::class);
        $this->call(detallesdocumentosestadotipoenvioTableSeeder::class);
        $this->call(AltaDireccionTableSeeder::class);
        $this->call(GerenciaTableSeeder::class);
        $this->call(SubGerenciaTableSeeder::class);
        $this->call(OficinaTableSeeder::class);
        $this->call(detallesdocumentoscertificoenvioTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(Cargos_UserTableSeeder::class);
        $this->call(CantidadEnvioAreaTableSeeder::class);
    }
}
