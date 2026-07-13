@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold text-gray-800 mb-6">Profil</h1>

<div class="space-y-6">
    <div class="p-4 sm:p-8 bg-white shadow-sm border rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-sm border rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-pkl-info-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-sm border rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-sm border rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection