@extends('admin.layouts.index')

@section('main')
    <x-insert :action="route('users.update',['user'=>$user->id])" method="put">
        <div class="row" style="margin-bottom: 24px;">
            <div class="col-auto">
                <x-switch
                    label="Statut du compte"
                    :checked="$user->activated===\App\Http\Enumerations\Activated::Enabled"
                    position="start"
                    name="activated"></x-switch>
            </div>
        </div>
        <div class="row" style="margin-bottom: 24px;">
            <div class="col-auto">
                <x-image-picker
                    label="Image de profil"
                    name="image_path"
                    :required="false"
                    icon="user"
                    :url="$user->imageBySize(200,200) ?? null"
                    width="200px"
                    height="200px"></x-image-picker>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <x-input
                    label="Nom"
                    placeholder="Saisir le nom de l'utilisateur"
                    name="firstname"
                    :autofocus="true"
                    :required="true"
                    :focus="true"
                    :value="old('firstname') ?? $user->firstname"></x-input>
            </div>
            <div class="col-12 col-md-6">
                <x-input
                    label="Prénom"
                    placeholder="Saisir le prénom de l'utilisateur"
                    name="lastname"
                    :required="true"
                    :value="old('lastname') ?? $user->lastname"></x-input>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <x-input
                    label="Email"
                    placeholder="Saisir l'email"
                    type="email"
                    description="Identifiant de connexion"
                    name="email"
                    :required="true"
                    :value="old('email') ?? $user->email"></x-input>
            </div>
            <div class="col-12 col-md-6">
                <x-input
                    label="Numéro de téléphone"
                    placeholder="Saisir le numéro de l'utilisateur"
                    description="Numéro personnel de l'utilisateur"
                    name="phone"
                    type="tel"
                    :required="true"
                    :value="old('phone') ?? $user->phone"></x-input>
            </div>
        </div>
        @granted('ROLE_USERS_AUTHORISATION')
        <div class="row">
            <div class="col-12">
                <div class="kh-input-custom">
                    <div style="margin: 8px 0;overflow: hidden;">
                        <div class="row">
                            @foreach(checkedMenu($user->role) as $item)
                                <div class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-2 kh-group_item"
                                     style="margin-bottom: 16px;">
                                    <x-group
                                        :label="$item['label']"
                                        :name="$item['name']"
                                        :value="$item['value']"></x-group>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <label>
                        Autorisations
                        <span>**</span>
                    </label>
                </div>
            </div>
        </div>
        @endgranted
        <div class="row">
            <div class="col-auto">
                <x-a
                    label="Modifier le mot de passe"
                    class-name="warning"
                    :href="route('password_reset.index',['user'=>$user->id])"
                    svg="lock"></x-a>
            </div>
        </div>
    </x-insert>
@endsection

@section('title')
    {{ $user->lastname.' '.$user->firstname }} - Edition
@endsection
@section('navigate')
    <x-navigate-bar>
        <x-navigate-bar-link
            :url="route('users.index')"
            label="Utilisateurs"></x-navigate-bar-link>
        <x-navigate-bar-link
            :url="\Illuminate\Support\Facades\URL::current()"
            :label="$user->lastname.' '.$user->firstname"></x-navigate-bar-link>
        <x-navigate-bar-link
            :url="\Illuminate\Support\Facades\URL::current()"
            label="Edition"></x-navigate-bar-link>
    </x-navigate-bar>
@endsection
