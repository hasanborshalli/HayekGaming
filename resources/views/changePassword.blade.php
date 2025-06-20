<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" sizes="32x32" href="/img/white-logo.svg">
  <link
    href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="stylesheet" href="/css/changePassword.css">
  <title>Change Password</title>
</head>

<body>
  @if (session('message'))
  <div id="toast" class="toast">{{ session('message') }}</div>
  <script>
    // Show toast for 3 seconds then fade out
        window.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        });
  </script>
  @endif
  <x-navigator />
  <section class="change-password-page">
    <h1 class="page-title">Change Password</h1>

    <div class="form-container">
      <form id="passwordForm" method="POST" action="/admin/changePassword">
        @csrf
        <label for="oldPassword">Old Password</label>
        <input type="password" id="oldPassword" name="oldPassword" required>
        @error('oldPassword')
        <p style="color:red">{{$message}}</p>
        @enderror
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="password" required>
        @error('password')
        <p style="color:red">{{$message}}</p>
        @enderror

        <label for="confirmPassword">Confirm New Password</label>
        <input type="password" id="confirmPassword" name="password_confirmation" required>
        @error('password_confirmation')
        <p style="color:red">{{$message}}</p>
        @enderror


        <input type="submit" class="btn" value="Change Password">
      </form>
    </div>
  </section>
</body>

</html>