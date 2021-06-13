<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Config extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'city'     => 'São Paulo',
            'address'  => 'Rua Augusta, 1508',
            'neigh'    => 'Consolação',
            'state'    => 'São Paulo',
            'uf'       => 'SP',
            'zip'      => '01304001',
            'rf'       => 'rf029205',
            'profile'  => 'admin',
            'remember_token' => Str::random(10)
        ]);

        $events_array = [
            [
                'name' => 'Hackaton Fam 2018',
                'season' => 2018
            ],
            [
                'name' => 'Hackaton Fam 2019',
                'season' => 2019
            ],
            [
                'name' => 'Hackaton Fam 2020',
                'season' => 2020
            ]
        ];

        foreach ($events_array as $data) {
            Event::create($data);
        }

        \App\Models\User::factory(351)->create();

        $users = User::all();

        $event_one   = Event::first();
        $event_two   = Event::where('id', 2)->first();
        $event_three = Event::where('id', 3)->first();

        $number_one = random_int(30, 60);
        $number_two = random_int(30, 60);
        $i = 0;

        while($i <= random_int(270, 330)) {
            $number = random_int(10, 330);
            $event_one->users()->syncWithoutDetaching($number);
            $i++;
        }

        $i = 0;
        while($i <= random_int(270, 280)) {
            $number = random_int(10, 351);
            $event_two->users()->syncWithoutDetaching($number);
            $i++;
        }

        $i = 1;
        while($i <= 351) {
            $event_three->users()->syncWithoutDetaching($i);
            $i++;
        }
    }
}
