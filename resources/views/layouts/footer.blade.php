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
        <span class="developed-by">{{__('Sitio diseñado y desarrollado por')}}<a href="https://nicolasgelabert.com.ar" target="_blank"> Nicolás Gelabert</a></span>
        <ul class="flex gap-x-4">
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                    <li>
                        <a class="flex items-center gap-x-1 opacity-50" href="{{ route('lang.switch', $lang) }}">
                            <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                            <span>{{$language['display']}}</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a class="flex items-center gap-x-1" href="{{ route('lang.switch', $lang) }}">
                            <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                            <span>{{$language['display']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</footer>