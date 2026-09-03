<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CareTrack</title>
    <style>
        body { font-family: -apple-system, sans-serif; background: #f4f6f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; padding: 32px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); width: 100%; max-width: 380px; }
        h1 { font-size: 20px; margin-bottom: 8px; color: #0E8E82; }
        p { color: #666; font-size: 14px; margin-bottom: 24px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #333; }
        input { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 16px; font-size: 14px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0E8E82; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; }
        .errors { background: #fdecea; color: #b3261e; padding: 10px 12px; border-radius: 8px; font-size: 13px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Reset your password</h1>
        <p>Enter a new password for your CareTrack account.</p>

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/reset-password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required>

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required minlength="8">

            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>