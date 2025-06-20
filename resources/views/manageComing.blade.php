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
  <link rel="stylesheet" href="/css/manageComing.css">
  <title>Coming Soon Image</title>
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
  <section class="manageComing-page">
    <h1 class="page-title">Coming Soon Image</h1>

    <div class="image-container">
      <h3>Coming Soon Image (700x380)</h3>
      @error('image')
      <p style="color:red">{{ $message }}</p>
      @enderror
      <form action="/admin/comingSoon/edit" method="POST" enctype="multipart/form-data">
        @csrf
        <img src="/storage/comingSoon/{{$image->image}}" alt="Coming Soon Image" id="comingSoonImg" loading="lazy">
        <br>
        <input type="file" accept="image/*" name="image" id="imageInput" style="display: none;" required>
        <button type="button" class="btn" onclick="document.getElementById('imageInput').click()">Change Image</button>
        <br>
        <button type="submit" class="btn"> Save Image</button>
      </form>
    </div>

  </section>


  <script>
    const imageInput = document.getElementById('imageInput');
  const comingSoonImg = document.getElementById('comingSoonImg');

  imageInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        comingSoonImg.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
  </script>



</body>

</html>