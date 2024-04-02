<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $usersData = [
            [
               'name'   =>'Admin',
               'email'  =>'admin@example.com',
               'empresas_id'=> '1',
               'setors_id'=> '0',
               'status_avaliacao'=>'0',
               'type' => 1,
               'password' => Hash::make('12345678')
            ],
            [
               'name'       => 'User',
               'email'      => 'user@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Pedro',
               'email'      => 'Pedrouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Antonio',
               'email'      => 'Antoniouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Mauricio',
               'email'      => 'mauriciouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Fernando',
               'email'      => 'fernandouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Mauro',
               'email'      => 'maurouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
    
            [
               'name'       => 'Felipe',
               'email'      => 'felipeuser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Leonardo',
               'email'      => 'leonardouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Sthephanie',
               'email'      => 'sthephanieuser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'raimunda',
               'email'      => 'raimundauser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Lara',
               'email'      => 'Larauser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'pietra',
               'email'      => 'pietrauser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'amanda',
               'email'      => 'amandauser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'theodora',
               'email'      => 'theodorauser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
               'name'       => 'Marquito',
               'email'      => 'marquitouser@example.com',
               'empresas_id'=> '1',
               'setors_id'=>'1',
               'status_avaliacao'=>'0',
               'type'   => 0,
               'password'   => Hash::make('12345678')
            ],
            [
                'name'            => 'José Silva',
                'email'           => 'josesilva@example.com',
                'empresas_id'     => '1',
                'setors_id'       => '1',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Ana Santos',
                'email'           => 'anasantos@example.com',
                'empresas_id'     => '1',
                'setors_id'       => '1',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Carlos Oliveira',
                'email'           => 'carlosoliveira@example.com',
                'empresas_id'     => '2',
                'setors_id'       => '2',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Mariana Costa',
                'email'           => 'marianacosta@example.com',
                'empresas_id'     => '2',
                'setors_id'       => '2',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Fernanda Silva',
                'email'           => 'fernandasilva@example.com',
                'empresas_id'     => '3',
                'setors_id'       => '3',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Rafael Oliveira',
                'email'           => 'rafaeloliveira@example.com',
                'empresas_id'     => '3',
                'setors_id'       => '3',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Patrícia Santos',
                'email'           => 'patriciasantos@example.com',
                'empresas_id'     => '3',
                'setors_id'       => '3',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Carlos Rodrigues',
                'email'           => 'carlosrodrigues@example.com',
                'empresas_id'     => '3',
                'setors_id'       => '3',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Fernanda Oliveira',
                'email'           => 'fernandaoliveira@example.com',
                'empresas_id'     => '4',
                'setors_id'       => '4',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            [
                'name'            => 'Roberto Silva',
                'email'           => 'robertosilva@example.com',
                'empresas_id'     => '4',
                'setors_id'       => '4',
                'status_avaliacao'=> '0',
                'type'            => 0,
                'password'        => Hash::make('12345678')
            ],
            // Adicione mais registros conforme necessário
            
    
            
           
            
        ];
        foreach ($usersData as $key => $val) {
            User::create($val);
            
        }
    }
}
