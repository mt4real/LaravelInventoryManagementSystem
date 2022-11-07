@extends('layouts.backend.backend_design')
@section('content')
    <main class="content">
        <h1 class="h3 mb-3">{{ __('Manage User Settings') }}</h1>
        <div class="container-fluid p-0">
            <div class="card rounded">
                <div class="card-title">

                </div>
                <div class="card-body">
                    <form id="profileAvatarImage">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" name="profile_avatar" type="checkbox" id="profileAvatar">
                            <label class="form-check-label" for="check_profileAvatar">
                                Use Avatar as profile image
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.utilities.general_modal')
@endsection
