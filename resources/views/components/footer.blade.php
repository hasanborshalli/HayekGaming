<footer>
    <section class="left-footer">
        <a href="/"><img src="/img/white-logo.webp" alt="Logo"></a>
        <div class="social-media">
            <a href="https://www.tiktok.com/@hayekgamingground?_t=ZS-8wv3bWKbLqz&_r=1" traget="_blank"><img
                    src="/img/tiktok.webp" alt="Tiktok" loading="lazy"></a>
            <a href="https://www.instagram.com/hayekgaming?igsh=MW1jaG53eTM2dGZ4NQ==" traget="_blank"><img
                    src="/img/insta.webp" alt="Instagram" loading="lazy"></a>
            <a href="https://www.facebook.com/share/1CF7SLfHAN/" traget="_blank"><img src="/img/fb.webp" alt="Facebook"
                    loading="lazy"></a>
        </div>
    </section>
    <section class="quick-links">
        <h3>Quick Links</h3>
        <ul>
            <a href="/">
                <li>Home</li>
            </a>
            @foreach ($categories as $category)
            <a href="/products/{{$category->id}}">
                <li>{{$category->name}}</li>
            </a>
            @endforeach


        </ul>
    </section>
    <section class="contact">
        <h3>Get in touch</h3>
        <ul>
            <a href="mailto:hgg@hayekgaming.com" target="_blank">
                <li><img src="/img/sms.webp" loading="lazy" /> hgg@hayekgaming.com</li>
            </a>
            <a href="https://wa.me/96178904703" target="_blank">
                <li><img src="/img/call.webp" loading="lazy" /> +961 78 904 703</li>
            </a>
        </ul>
    </section>
</footer>
<div style="width:100%;background-color:#2a2670; text-align:center;">
    <p style="margin:0;font-family: 'Archivo Black';font-size:1.3rem;color:white;">
        Powered By
        <a target="_blank" href="https://brndnglb.com" style="text-decoration:none;">
            <span style="font-family: 'Archivo Black'; color: black;font-size:1.8rem;">
                Brndng
            </span>
            <span style="font-family: 'Archivo Black';color:#FF914D;font-size:2.5rem;">
                .
            </span>
        </a>
    </p>
</div>