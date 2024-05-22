<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Juan', 'surname' => 'Pérez', 'email' => 'admin@admin.com', 'password' => 'admin'],
            ['name' => 'Milton', 'surname' => 'Zini', 'email' => 'milton.zini@rednodo.com', 'password' => 'admin'],
            ['name' => 'Lucas', 'surname' => 'Ferro', 'email' => 'lucas.ferro@rednodo.com', 'password' => 'admin'],
            ['name' => 'Lucas', 'surname' => 'Marini', 'email' => 'lucas.marini@rednodo.com', 'password' => 'admin'],
            ['name' => 'Juan', 'surname' => 'Marini', 'email' => 'juan.marini@rednodo.com', 'password' => 'admin'],

            ['name' => 'Gonza', 'surname' => 'Ponieman', 'email' => 'gonzalo.ponieman@rednodo.com', 'password' => 'admin'],
            ['name' => 'Juan', 'surname' => 'López', 'email' => 'juan.perez@mail.com', 'password' => 'passjuanperez123F+'],
            ['name' => 'María', 'surname' => 'García', 'email' => 'maria.garcia@mail.com', 'password' => 'passmariagarcia123F+'],
            ['name' => 'Luis', 'surname' => 'Rodríguez', 'email' => 'luis.rodriguez@mail.com', 'password' => 'passluisrodriguez123F+'],
            ['name' => 'Ana', 'surname' => 'Martínez', 'email' => 'anamartinez@mail.com', 'password' => 'passanamartinez123F+'],
            ['name' => 'Pedro', 'surname' => 'López', 'email' => 'pedro.lopez@mail.com', 'password' => 'passpedrolopez123F+'],
            ['name' => 'Laura', 'surname' => 'Fernández', 'email' => 'laura.fernandez@mail.com', 'password' => 'passlaurafernandez123F+'],
            ['name' => 'Carlos', 'surname' => 'Gómez', 'email' => 'carlos.gomez@mail.com', 'password' => 'passcarlosgomez123F+'],
            ['name' => 'Sara', 'surname' => 'Ruiz', 'email' => 'sara.ruiz@mail.com', 'password' => 'passsararuiz123F+'],
            ['name' => 'Roberto', 'surname' => 'Sánchez', 'email' => 'roberto.sanchez@mail.com', 'password' => 'passrobertosanchez123F+'],
            ['name' => 'Elena', 'surname' => 'Morales', 'email' => 'elena.morales@mail.com', 'password' => 'passelenamorales123F+'],
            ['name' => 'Javier', 'surname' => 'Díaz', 'email' => 'javier.diaz@mail.com', 'password' => 'passjavierdiaz123F+'],
            ['name' => 'Rosa', 'surname' => 'Ortega', 'email' => 'rosa.ortega@mail.com', 'password' => 'passrosaortega123F+'],
            ['name' => 'David', 'surname' => 'Hernández', 'email' => 'david.hernandez@mail.com', 'password' => 'passdavidhernandez123F+'],
            ['name' => 'Isabel', 'surname' => 'López', 'email' => 'isabel.lopez@mail.com', 'password' => 'passisabellopez123F+'],
            ['name' => 'Pablo', 'surname' => 'Martínez', 'email' => 'pablo.martinez@mail.com', 'password' => 'passpablomartinez123F+'],
            ['name' => 'Carmen', 'surname' => 'Gutiérrez', 'email' => 'carmen.gutierrez@mail.com', 'password' => 'passcarmengutierrez123F+'],
            ['name' => 'Daniel', 'surname' => 'García', 'email' => 'daniel.garcia@mail.com', 'password' => 'passdanielgarcia123F+'],
            ['name' => 'Marta', 'surname' => 'Vargas', 'email' => 'marta.vargas@mail.com', 'password' => 'passmartavargas123F+'],
            ['name' => 'Antonio', 'surname' => 'Fernández', 'email' => 'antonio.fernandez@mail.com', 'password' => 'passantoniofernandez123F+'],
            ['name' => 'Eva', 'surname' => 'López', 'email' => 'eva.lopez@mail.com', 'password' => 'passevalopez123F+'],
            ['name' => 'José', 'surname' => 'Sánchez', 'email' => 'jose.sanchez@mail.com', 'password' => 'passjosesanchez123F+'],
            ['name' => 'Sandra', 'surname' => 'Martínez', 'email' => 'sandra.martinez@mail.com', 'password' => 'passsandramartinez123F+'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'surname' => $user['surname'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }
    }
}
