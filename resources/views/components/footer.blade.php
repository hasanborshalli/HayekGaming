<footer>
    <section class="left-footer">
        <a href="/"><img src="/img/white-logo.svg" alt="Logo"></a>
        <div class="social-media">
            <a href="https://www.tiktok.com/@hayekgamingground?_t=ZS-8wv3bWKbLqz&_r=1" traget="_blank"><img
                    src="/img/tiktok.svg" alt="Tiktok" loading="lazy"> <span class="page-name">@hayekgaming</span></a>
            <a href="https://www.instagram.com/hayekgaming?igsh=MW1jaG53eTM2dGZ4NQ==" traget="_blank"><img
                    src="/img/insta.svg" alt="Instagram" loading="lazy"><span class="page-name">@hayekgaming</span></a>
            <a href="https://www.facebook.com/share/1CF7SLfHAN/" traget="_blank"><img src="/img/fb.svg" alt="Facebook"
                    loading="lazy"><span class="page-name">@hayekgaming</span></a>
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
    <p class="small-text">
        Powered By
        <a target="_blank" href="https://brndnglb.com" style="text-decoration:none;">
            <span class="medium-text">
                Brndng
            </span>
            <span class="large-text">
                .
            </span>
        </a>
    </p>
</div>