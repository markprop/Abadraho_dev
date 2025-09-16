<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "Testing login for suresh.kumar@markproperties.pk...\n";

// Test the password
$plainPassword = 'Suresh123';
$hashedPassword = '$2y$10$i9TIMOqCoiYUDqygmNy/IOxmf.j6OPAPI1A.n23syZ/NSOu1gkiJm';

echo "Plain password: " . $plainPassword . "\n";
echo "Stored hash: " . $hashedPassword . "\n";

// Check if password matches
if (Hash::check($plainPassword, $hashedPassword)) {
    echo "Password verification: SUCCESS\n";
} else {
    echo "Password verification: FAILED\n";
    
    // Generate new hash
    $newHash = Hash::make($plainPassword);
    echo "New hash: " . $newHash . "\n";
    
    // Update the user with correct password
    $user = \App\Models\User::find(742);
    $user->password = $newHash;
    $user->save();
    echo "Updated user password\n";
}

// Test authentication
$credentials = [
    'email' => 'suresh.kumar@markproperties.pk',
    'password' => 'Suresh123'
];

if (Auth::attempt($credentials)) {
    echo "Authentication: SUCCESS\n";
    echo "User ID: " . Auth::id() . "\n";
    echo "User Type: " . Auth::user()->user_type_id . "\n";
} else {
    echo "Authentication: FAILED\n";
}
