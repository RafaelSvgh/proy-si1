<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Configuración de redirección después del login basada en roles
        Fortify::authenticateUsing(function (Request $request) {
            $user = Auth::getProvider()->retrieveByCredentials($request->only(Fortify::username(), 'password'));
            
            if ($user &&
                Auth::getProvider()->validateCredentials($user, ['password' => $request->password])) {
                
                // Redirección basada en roles después del login
                $redirectTo = $this->getRedirectPathByRole($user);
                $request->session()->put('url.intended', $redirectTo);
                
                return $user;
            }
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    /**
     * Obtiene la ruta de redirección según el rol del usuario
     */
    protected function getRedirectPathByRole($user): string
    {
        if ($user->hasRole('admin')) {
            return route('admin.dashboard');
        }
        if ($user->hasRole('candidato')) {
            return route('candidato.welcome');
        }
        if ($user->hasRole('reclutador')) {
            return route('admin.dashboard');
        }
        
        return route('/');
    }
}
