<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="/img/otus_auth.png">
                        <span class="text-black-50">{{$email}}</span>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile info</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">First name</label><input type="text" class="form-control" placeholder="Fist name" value=""></div>
                            <div class="col-md-6"><label class="labels">Last name</label><input type="text" class="form-control" value="" placeholder="Last name"></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col col-md-2"> 
                                <label for="gender"> Gender</label>
                                <select name="gender">
                                    <option value="other" selected>N/A</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Interests</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">City</label><input type="text" class="form-control" placeholder="City" value=""></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>