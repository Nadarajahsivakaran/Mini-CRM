<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <title>Sign up</title>
</head>

<body>

    <script>
         $(function(){
            setTimeout(function(){
                $('.session-msg').slideUp();
            },5000);
        });
    </script>

    @if (\Session::has('success'))
    <div class="alert alert-success session-msg" style="width: 50%; margin:0 auto 15px auto; text-align:center;">
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif

    @if (\Session::has('fail'))
    <div class="alert alert-success session-msg" style="width: 50%; margin:0 auto 15px auto; text-align:center;">
        <p>{{\Session::get('fail')}}</p>
    </div>
    @endif


    <div class="signup">

        <h1>Log in</h1>

        <form action="/login" method="post">
            @csrf


            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="name">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>

            <button type="submit" class="btn btn-primary">Submit</button>

            <h6> if you don't have an account <a href="/signup">Sign up</a></h6>
        </form>

    </div>

</body>

</html>
