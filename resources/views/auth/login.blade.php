@extends('layout.master_auth')

@section('content')
<br><br>
<div class="cont">
    <div class="form sign-in">
        <h2>Welcome </h2>
        @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li style="font-size: 0.9em;">
                        {{ $error === 'بيانات الاعتماد المدخلة غير صحيحة' ? 'The credentials provided are incorrect.' : $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" required />
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="password" required />
            </label>
            <p class="forgot-pass">Forgot password?</p>
            <button type="submit" class="submit">Sign In</button>
        </form>
    </div>
    <div class="sub-cont">
        <div class="img">
            <div class="img__btn">
                <span class="m--up">Sign Up</span>
                <span class="m--in">Sign In</span>
            </div>
        </div>
        <div class="form sign-up">
            <h2>Create your Account</h2>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('register') }}">
    @csrf
    <label>
        <span>Name</span>
        <input type="text" name="name" value="{{ old('name') }}" required maxlength="255" />
    </label>
    <label>
        <span>Email</span>
        <input type="email" name="email" value="{{ old('email') }}" required />
    </label>
    <label>
        <span>Password</span>
        <input type="password" name="password" required minlength="6" />
    </label>
    <button type="submit" class="submit">Sign Up</button>
</form>

        </div>
    </div>
</div>

<script>
    document.querySelector('.img__btn').addEventListener('click', function() {
        document.querySelector('.cont').classList.toggle('s--signup');
    });
</script>
@endsection
