@extends('auth.layout', ['title' => 'Sign up'])

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
        [
            'label' => 'Confirm password',
            'input' => 'password_confirmation',
            'type' => 'password',
        ]
    ];
?>

@section('form')
<form class="mx-1" action="/signup" method="post">
    @foreach ($fields as $field)
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
                <label class="form-label">{{ $field['label'] }}</label>
                <input type="{{ $field['type'] }}" name="{{ $field['input'] }}" class="form-control" />
            </div>
        </div>
    @endforeach
    <div class="form-check d-flex justify-content-center mb-5">
        <input class="form-check-input me-2" type="checkbox" name="terms" value="1" />
        <label class="form-check-label">
            I agree all statements in <a href="#!">Terms of service</a>
        </label>
    </div>
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
    </div>
</form>
@endsection
