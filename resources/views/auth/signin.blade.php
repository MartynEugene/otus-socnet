@extends('auth.layout', ['title' => 'Sign in'])

<?php
    $fields = [
        [
            'label' => 'Email',
            'input' => 'email',
            'type' => 'email',
        ],
        [
            'label' => 'Password',
            'input' => 'password',
            'type' => 'password',
        ],

    ];
?>

@section('form')
<form class="mx-1" action="/signin" method="post">
    @foreach ($fields as $field)
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
                <label class="form-label">{{ $field['label'] }}</label>
                <input type="{{ $field['type'] }}" name="{{ $field['input'] }}" class="form-control" />
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
    </div>
</form>
@endsection
