<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        @include('widgets.navbar')
        <div class="container h-100">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 col-xl-11">
                    @foreach ($users as $user)
                    <div class="card">
                        <div class="row p-3" style="0.25rem">
                            <div class="col-md-3">
                                <div class="card-body text-left">
                                    <h5 class="card-title">{{$user['first_name'] . ' ' . $user['last_name'] }}</h5>
                                    <p class="card-text">{{$user['email']}}</p>
                                    <p class="card-text">{{$user['city']}}</p>
                                    @if ($user['is_friend'] == 'none')
                                        <button onclick="FriendshipController.befriend({{ $user['id'] }})" class="btn btn-primary">Add friend</button>
                                    @endif
                                    @if ($user['is_friend'] == 'both')
                                        <button onclick="FriendshipController.unfriend({{ $user['id'] }})" class="btn btn-primary">Unfriend</button>
                                    @endif
                                    @if ($user['is_friend'] == 'incoming')
                                        <button onclick="FriendshipController.accept({{ $user['id'] }})" class="btn btn-primary">Accept friend</button>
                                        <button onclick="FriendshipController.decline({{ $user['id'] }})" class="btn btn-primary">Decline request</button>
                                    @endif
                                    @if ($user['is_friend'] == 'proposed')
                                        <button onclick="FriendshipController.cancel({{ $user['id'] }})" class="btn btn-primary">Cancel request</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="text-right">
                                    <p class="card-text">{{$user['hobbies']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script src="js/components/friendship/FriendshipController.js"></script>
    </body>
</html>