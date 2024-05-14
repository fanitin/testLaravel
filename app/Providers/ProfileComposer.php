<?php
namespace App\Providers;

use App\Models\Result;
use App\Models\User;
use Illuminate\View\View;

class ProfileComposer{

 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('resultsNavbar', Result::all()->count());
        $view->with('usersNavbar', User::all()->count());
    }
}