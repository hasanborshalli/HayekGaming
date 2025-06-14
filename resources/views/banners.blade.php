<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" sizes="32x32" href="/img/white-logo.png">
    <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/banners.css">
    <title>Manage Banners</title>
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
    <x-navigator/>
    <section class="banners-page">
        <h1 class="page-title">Manage Banners</h1>
  <button class="btn" onclick="window.location.href='/admin/addBanner'">➕ Add Banner</button>

  <div class="table-container">
    <table>
      <thead>
        <tr>
            <th></th>
          <th>Banner</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="bannerTableBody">
        <!-- Sample Banner Row -->
        @foreach ($banners as $banner)
        <tr>
            <td>{{$loop->iteration}}</td>
          <td><img src="/storage/banners/{{$banner->image}}" alt="Banner" loading="lazy"></td>
          <td class="action-buttons">
            <button class="btn" onclick="window.location.href = '/admin/editBanner/'+{{$banner->id}}">Edit</button>
            <button class="btn red" onclick="deleteBanner({{$banner->id}}, this)" data-id="{{ $banner->id }}">Delete</button>
          </td>
        </tr>
        @endforeach
        
        <!-- Add more banners dynamically -->
      </tbody>
    </table>
  </div>
  <div id="delete-toast" class="delete-toast"></div>
<div id="confirmOverlay" class="overlay" style="display: none;">
  <div class="confirm-box">
    <p>Are you sure you want to delete this banner?</p>
    <div class="buttons">
      <button class="btn red" id="confirmYes">Yes</button>
      <button class="btn" id="confirmNo">No</button>
    </div>
  </div>
</div>
    </section>

    <script src="/js/banners.js">
   
  </script>
</body>
</html>