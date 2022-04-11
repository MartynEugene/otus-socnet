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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-body text-left">
                                    <h5 class="card-title">{{$user['first_name'] . ' ' . $user['last_name'] }}</h5>
                                    <p class="card-text">{{$user['email']}}</p>
                                    <p class="card-text">{{$user['city']}}</p>
                                    <a href="#" class="btn btn-primary">Add friend</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <p class="card-text">{{$user['hobbies']}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>