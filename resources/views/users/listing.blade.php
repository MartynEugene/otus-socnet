<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container h-100">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-xl-11">
                    @foreach ($users as $user)
                    <div class="card" style="width: 100%;">
                        <div class="row p-3">
                            <div class="col-md-3">
                                <div class="card-body text-left">
                                    <h5 class="card-title">{{$user['first_name'] . ' ' . $user['last_name'] }}</h5>
                                    <p class="card-text">{{$user['email']}}</p>
                                    <p class="card-text">{{$user['city']}}</p>
                                    @if ($user['is_friend'] == 'both')
                                        <a href="#" class="btn btn-primary">Unfriend</a>
                                    @endif
                                    @if ($user['is_friend'] == 'proposed')
                                        <a href="#" class="btn btn-primary">Remove request</a>
                                    @endif
                                    @if ($user['is_friend'] == 'incoming')
                                        <a href="#" class="btn btn-primary">Accept friend</a>
                                    @endif
                                    @if ($user['is_friend'] == 'none')
                                        <a href="#" class="btn btn-primary">Add friend</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="text-right">
                                    <p class="card-text">{{$user['hobbies']}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>