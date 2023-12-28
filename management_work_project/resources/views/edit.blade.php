<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{background-image: url(https://cutewallpaper.org/21/pixel-wallpaper-gif/Pixel-art-wallpaper-gif-GIF-Images-Download.gif) !important; background-size: cover}
    </style>
</head>
<body>
    <div class="container" style="width: 50%; margin-top: 100px;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Profile</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('profileUpdate')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Email</strong>
                                <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" disabled placeholder="Input Email">
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <strong>Username</strong>
                            <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                            <div class="input-group">
                              <div class="input-group-text">@</div>
                              <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" id="inlineFormInputGroupUsername" placeholder="Username">
                            </div>
                        </div> --}}
                          
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Bio</strong>
                                <input type="text" name="bio" value="{{Auth::user()->bio}}" class="form-control" placeholder="Input Bio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Phone</strong>
                                <input type="number" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Input Phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Gender</strong>
                                <input type="text" name="gender" value="{{Auth::user()->gender}}" class="form-control" placeholder="Input Gender">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Birthday</strong>
                                <input type="date" name="birthday" value="{{Auth::user()->birthday}}" class="form-control" placeholder="Input Birthday">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success mt-2">Update</button>
                            <button class="btn btn-primary mt-2 profile-back">Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.querySelector(".profile-back").onclick = (e) => {
        e.preventDefault();
        window.location.href = "{{route('profile')}}";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>