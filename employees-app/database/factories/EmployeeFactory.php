<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nameSet = $this->nameSet();
        $genderData = $nameSet['genderData'][array_rand($nameSet['genderData'])];
        $randName = $genderData['names'][array_rand($genderData['names'])];
        $randSurname = $genderData['surnames'][array_rand($genderData['surnames'])];
        $randPatronymic = $genderData['patronymics'][array_rand($genderData['patronymics'])];
        $randPosition = $nameSet['positions'][array_rand($nameSet['positions'])];

        return [
            "name"          => $randName,
            "patronymic"    => $randPatronymic,
            "surname"       => $randSurname,
            "birthday"      => $this->faker->date('Y-m-d', strtotime("31 December 2000")),
            "position"      => $randPosition,
            "phone"         => '+' . random_int(71111111111, 79999999999),
            "avatar_url"    => $this->faker->imageUrl()
        ];
    }

    private function nameSet() : array
    {
        $positions = [
            'Кассир', 
            'Охранник', 
            'Супервайзер', 
            'Оператор', 
            'Консультант', 
            'Промоутер'
        ];

        $surnames = [
            'Шпак', 
            'Клинтон', 
            'Петренко', 
            'Смит', 
            'Рамирес', 
            'Симпсон'
        ];

        $maleNames = [
            'Виктор', 
            'Олег', 
            'Андрей', 
            'Станислав', 
            'Евгений', 
            'Александр'
        ];

        $malePatronymics = [
            'Витальевич', 
            'Андреевич', 
            'Станиславович'
        ];

        $femaleNames = [
            'Анна', 
            'Кристина', 
            'Светлана', 
            'Татьяна', 
            'Екатерина', 
            'Ольга'
        ];

        $femalePatronymics = [
            'Николаевна', 
            'Дмитриевна', 
            'Олеговна'
        ];

        return [
            'genderData' => [ 
                'male' => [
                    'surnames'      => $surnames, 
                    'names'         => $maleNames, 
                    'patronymics'   => $malePatronymics
                ],
                'female' => [
                    'surnames'      => $surnames, 
                    'names'         => $femaleNames, 
                    'patronymics'   => $femalePatronymics
                ]
            ],
            'positions' => $positions,
        ];
    }
}
