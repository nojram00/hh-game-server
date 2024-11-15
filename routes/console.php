<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('create-su', function(){
    User::factory()->create([
        'name' => 'admin',
        'email' => 'admin@example.com',
        'role' => User::ROLES['0'],
        'password' => 'changeme'
    ]);

    $this->comment('Superuser(Admin) created!');
    $this->comment('name: admin');
    $this->comment('email: admin@example.com');
    $this->comment('password: changeme');
});

Artisan::command('test-shit {params}', function(){
    $this->comment($this->argument('params'));
});

Artisan::command('get_section {id}', function(){
    $user = User::find($this->argument('id'));

    if($user != null)
    {
        $teacher = $user->teacher;

        $this->comment($user->name);

        return;
    }

    $this->comment('No User found');

});
