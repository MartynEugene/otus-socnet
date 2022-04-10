<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container rounded bg-white h-50 mt-5 mb-5">
                @if (!empty($error))
                    <span>Error: {{$error}}</span>
                @endif
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="/img/otus_auth.png">
                            <span class="text-black-50">{{$email ?? ''}}</span>
                        </div>
                    </div>
                    <form action="/info" method="post" class="col-md-8 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile info</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">First name</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Fist name"
                                        value="{{$info['first_name'] ?? ''}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Last name</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Last name" 
                                        value="{{$info['last_name'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col col-md-2"> 
                                    <label for="gender"> Gender</label>
                                    <select name="gender">
                                        <option value="other">N/A</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hobbies</label>
                                <textarea name="hobbies" class="form-control" rows="3">{{$info['hobbies'] ?? ''}}</textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">City</label>
                                <input type="text" name="city" class="form-control" placeholder="City" value="{{$info['city'] ?? ''}}"></div>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>