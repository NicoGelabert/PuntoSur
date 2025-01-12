<footer>
    <div class="footer-container">
        <div class="flex flex-col items-center gap-y-8">
            <div class="footer-logo" >
                <x-logo />
                <p class="text-4xl font-serif">chi balance</p>
                <p class="uppercase text-xs	font-sans_serif tracking-widest">therapies</p>
            </div>
            <p>11 Main Street, Dungloe, Donegal, F94 WR6T (above Kenneth Campbell's)</p>
            <x-social-icons />
            <ul class="footer-menu">
                @foreach ($services as $service)
                    <li>
                        <a href="{{ route('service.view', $service->slug) }}">
                            <span>{{ $service->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="flex flex-col gap-4">
                <a href="/politica-de-privacidad"><p>Cancelation policy & Terms and conditions</p></a>
                <a href="/terminos-y-condiciones"><p>Cookies & Privacy policy</p></a>
            </div>
        </div>
    </div>
    <hr class="footer-divider" />
    <div class="post-footer">
        <span class="developed-by">Site designed and developed by <a href="https://chimicreativo.es" target="_blank">CHIMI CREATIVO</a></span>
    </div>
</footer>