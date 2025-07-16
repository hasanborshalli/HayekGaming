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
    <link rel="stylesheet" href="/css/addProduct.css">
    <title>Manage Moving Sentence</title>
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
    <section class="addProduct-page">
        <h1 class="page-title">Manage Moving Sentence</h1>

        <form method="POST" action="/admin/changeSentence">
            @csrf
            <div class="current">
                <h3>Current Moving Sentence</h3>
                <p>{{$sentence}}</p>
            </div>
            <div class="form-row">
                <div class="form-row">
                    <div class="form-group">
                        <label for="sentence">New Moving Sentence</label>
                        <input type="text" id="sentence" required name="sentence" value="{{old('sentence')}}">
                        @error('sentence')
                        <p style="color:red">{{$message}}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Change Moving Sentence" class="submit-btn" />
                </div>
        </form>
    </section>
</body>

</html>