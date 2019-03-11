<?php

namespace App\Listeners;

use App\Events\ContractCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\v2\User;

class ContractCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContractCreated  $event
     * @return void
     */
    public function handle(ContractCreated $event)
    {
        $individ = $event->getIndivid();
        $pin = $event->getPin();
        $users = User::where('person_tin', $individ['military']['inn'])
            ->get();

        foreach ($users as $user) {
            $user->fill(
                [
                    'person_name' => $individ['name_latin'],
                    'person_surname' => $individ['patronym_latin'],
                    'person_patronymic' => $individ['surname_latin'],
                    'person_pin' => $pin,
                    'data_user' => $individ,
                ]
            );

            $user->save();
        };

        User::updateOrCreate([
            'person_tin' => $individ['military']['inn'],
            'company_tin' => null,

        ],[
            'person_name' => $individ['name_latin'],
            'person_surname' => $individ['surname_latin'],
            'person_patronymic' => $individ['patronym_latin'],
            'type' => 1,
            'person_pin' => $pin,
            'data' => $individ,
        ]);

    }
}
