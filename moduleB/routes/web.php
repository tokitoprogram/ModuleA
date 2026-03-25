<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function() {
//     return view('welcome');
// });

Route::get('/', function() {
    return 'Hello from Laravel';
});

Route::get('about-us/{name}/{id}', function($name,$id) {
    $myName="Nikita";
    $name="tester";
    $email="tester@gmail.com";
    // return view('about')->with('name', $name)->with('email', $email);
    // return view('about', compact('name', 'email'));
    // return view('about', ['name'=>$name, 'email'=>$email]);

    return view('about', compact('myName', 'name','id'));
});

Route::view('contact-us/{name}/{id}', 'contactus');

Route::prefix('details/')->group(function() {
    Route::get('students', function() {
        return 'this is student';
    })->name('student-Details');
    Route::get('teacher', function() {
        return 'this is teacher';
    })->name('teachers-Details');
});


Route::get('student/{id}/{reg}', function($id, $reg) {
    return 'Your id:' . $id . 'registration num: '. $reg ;
});

Route::fallback(function() {
    return 'this page is no page';
});