<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class DashboardController extends Controller
{
    public function getProfiles() {
        $profiles = DB::table('profiles')->get();
        return response($profiles, 200);
    }

    public function getProfileByID(Request $r) {
        $profile = DB::table('profiles')->where('profile_id', $r['profile_id'])->get();
        return response($profile, 200);
    }

    public function createProfile(Request $r) {
        try {
            DB::table('profiles')->insert([
                'first_name' => $r['first_name'],
                'last_name' => $r['last_name'],
                'phone_number' => $r['phone_number'],
                'email' => $r['email'],
                'facebook_username' => $r['facebook_username'],
            ]);
            return response()->json([
                'message' => "Profil créé avec succès."
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Impossible de créer le profil. Veuillez réessayer plus tard.'
            ]);
        }
    }

    public function editProfile(Request $r) {
        try {
            DB::table('profiles')
            ->where('profile_id'. $r['profile_id'])
            ->update([
                'first_name' => $r['first_name'],
                'last_name' => $r['last_name'],
                'phone_number' => $r['phone_number'],
                'email' => $r['email'],
                'facebook_username' => $r['facebook_username'],
            ]);
            return response()->json([
                'message' => "Profil modifié avec succès."
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Impossible de modifier le profil. Veuillez réessayer plus tard.'
            ]);
        }
    }
}
