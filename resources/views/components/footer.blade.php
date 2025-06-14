<footer>
<section class="left-footer">
    <a href="/"><img src="/img/white-logo.png" alt="Logo"></a>
    <div class="social-media">
        <a href="https://www.tiktok.com/@hayekgamingground?_t=ZS-8wv3bWKbLqz&_r=1" traget="_blank"><img src="/img/tiktok.png" alt="Tiktok" loading="lazy"></a>
        <a href="https://www.instagram.com/hayekgaming?igsh=MW1jaG53eTM2dGZ4NQ==" traget="_blank"><img src="/img/insta.png" alt="Instagram" loading="lazy"></a>
        <a href="https://www.facebook.com/share/1CF7SLfHAN/" traget="_blank"><img src="/img/fb.png" alt="Facebook" loading="lazy"></a>
    </div>
</section>
<section class="quick-links">
    <h3>Quick Links</h3>
    <ul>
        <a href="/"><li>Home</li></a>
        @foreach ($categories as $category) 
        <a href="/products/{{$category->id}}"><li>{{$category->name}}</li></a>
        @endforeach
        
        
    </ul>
</section>
<section class="contact">
    <h3>Get in touch</h3>
    <ul>
        <a href="mailto:hgg@hayekgaming.com" target="_blank"><li><img src="/img/sms.png" loading="lazy"/> hgg@hayekgaming.com</li></a>
        <a href="https://wa.me/96178904703" target="_blank"><li><img src="/img/call.png" loading="lazy"/> +961 78 904 703</li></a>
    </ul>
</section>
</footer>