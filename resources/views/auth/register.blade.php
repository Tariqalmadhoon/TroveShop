{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    <title>Register</title>
    <style>
        html,
        body {
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
            background: url("https://img.freepik.com/free-photo/abstract-background-cement-wall-shadow-light-concept_53876-31788.jpg?ga=GA1.1.1770343920.1728489201&semt=ais_hybrid") no-repeat center center;
            background-size: cover;
            font-family: "Lato", sans-serif;
        }

        form {

            background: #faf5f3;
                width: 280px;
                margin-top: 50px;
                margin-bottom: 50px;
                position: absolute;
                z-index: 10;
                padding: 60px 60px 80px;
                left: 50%;
                margin-left: -230px;
                opacity: 0.85;
                border-radius: 10px;
        }

        form h2 {
            text-transform: uppercase;
            text-align: center;
            font-size: 18px;
            color: #2f1f1e;
            letter-spacing: 0.061em;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        form input {
            width: 100%;
            background: #fff;
            margin-bottom: 20px;
            appearance: none;
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 8px;
            font-size: 14px;
        }

        form input:focus {
            outline: none;
            border-bottom: 2px solid #444;
        }

        form .submit {
            background: black;
            color: #fff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }

        form .submit:hover {
            background: #484848;
        }

        .success-dialog {
            display: none;
            margin-top: 20px;
            color: green;
            font-size: 14px;
            text-align: center;
        }

        a {
            color: #2f1f1e;
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        a:hover {
            color: #484848;
        }

        .danger-name{
            color: red;
            position: absolute;
            bottom: 309px;
            font-size: 10.5px

        }


        .danger-email{
            color: red;
            position: absolute;
            bottom: 258px;
            font-size: 10.5px

        }



        .danger-password{
            color: red;
            position: absolute;
            bottom: 204px;
            font-size: 10.5px

        }



        .danger-passwordConfirm{
            color: red;
            position: absolute;
            bottom: 200px;
            font-size: 10.5px

        }





    </style>
</head>

<body>
    <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Register Now</h2>
        <input type="text" name="name" placeholder="Name"  autofocus />
        @error('name')
            <small class="danger-name">{{ $message }}</small>
        @enderror
        <input type="email" name="email" placeholder="Email"  />
        @error('email')
        <small class="danger-email">{{ $message }}</small>
        @enderror
        <input type="password" name="password" placeholder="Password"  />
        @error('password')
        <small class="danger-password">{{ $message }}</small>
        @enderror
        <input type="password" name="password_confirmation" placeholder="Confirm Password"  />
        @error('passwordConfirm')
        <small class="danger-passwordConfirm">{{ $message }}</small>
        @enderror
        <button type="submit" class="submit">Register</button>
        <a href="{{ route('login') }}">Already registered? Login</a>
        <div class="success-dialog">Registration successful!</div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/TweenMax.min.js"></script>

    <script>
        $(document).ready(function () {
            var form = $(".register-form");
            var submitButton = $(".submit");
            var successDialog = $(".success-dialog");
            var body = $("body");

            form.on("submit", function (e) {
                e.preventDefault();

                var tl = new TimelineLite();

                // Animation for submit button
                tl.to(submitButton, 0.3, {
                    scale: 0.9,
                    ease: Power2.easeOut,
                })
                    .to(submitButton, 0.3, {
                        scale: 1,
                        backgroundColor: "#484848",
                        ease: Power2.easeInOut,
                    })
                    .to(body, 0.5, {
                        backgroundColor: "#000",
                        opacity: 0.7,
                        ease: Power2.easeOut,
                        onComplete: function () {
                            // Show success dialog
                            successDialog.fadeIn();

                            // Simulate form submission
                            form.off("submit").submit();
                        },
                    });
            });
        });
    </script>
</body>

</html>
