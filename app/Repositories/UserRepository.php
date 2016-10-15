<?php

namespace App\Repositories;

use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class UserRepository
{
    public function findByFacebookId($facebookId)
    {
        return User::where('facebook_id', $facebookId)->first();
    }

    public function registerByFacebook(ProviderUser $facebookUser)
    {
        $user = $this->findByFacebookId($facebookUser->getId());

        if ($user == null) {
            $user = User::create([
                'facebook_id' => $facebookUser->getId(),
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
            ]);
        }

        app('auth')->login($user);

        return redirect()->to('/');
    }
}
