<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Proprietario;
use Faker\Generator as Faker;

$factory->define(Proprietario::class, function (Faker $faker) {
    return [
        'nome' => $faker->name, 
        'email' => $faker->unique()->safeEmail,
        'celular' => $faker->e164PhoneNumber, 
        'fixo' => $faker->e164PhoneNumber, 
        'cpf' => substr($faker->e164PhoneNumber,2,11), 
        'cep' => substr( $faker->postCode,1,9),
        'rua' => $faker->streetName, 
        'numero' => $faker->buildingNumber, 
        'complemento' => $faker->secondaryAddress, 
        'bairro'=> $faker->streetSuffix, 
        'cidade' => $faker->city, 
        'uf' => $faker->stateAbbr, 
        'pais' =>'Brasil'
    ];
});
