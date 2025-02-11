<x-app-layout>
    <div class="flex flex-col justify-center gap-12 max-w-screen-xl px-4 py-32 mx-auto md:px-16 overflow-hidden">
        <h3>{{ __('Privacy Policy') }}</h3>

        <p>{{ __('Last updated: February, 2025') }}</p>

        <div class="flex flex-col gap-4">
            <h6>{{ __('1. General Information') }}</h6>
            <p>{{ __('Chibalancetherapies.com, as the data controller, is committed to user privacy and ensures that personal data collected will be processed in accordance with the General Data Protection Regulation (GDPR) and other applicable regulations.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('2. Data Collected') }}</h6>
            
            <p>{{ __('We collect the following personal data through our forms:') }}</p>

            <div>
                <p class="strong">{{ __('Contact Form:') }}</p>
                <ul class="list-disc pl-12">
                    <li><p>{{ __('Name') }}</p></li>
                    <li><p>{{ __('Email') }}</p></li>
                    <li><p>{{ __('Phone') }}</p></li>
                    <li><p>{{ __('Message') }}</p></li>
                </ul>
            </div>

            <div>
                <p class="strong">{{ __('Automatically via Cookies:') }}</p>
                <ul class="list-disc pl-12">
                    <li><p>{{ __('Browsing data (IP address, device, visit duration).') }}</p></li>
                    <li><p>{{ __('Cookies: XSRF-TOKEN, _ga, _ga_9Q6H0QETRF, chibalance_session, laravel_cookie_consent, ls_smartpush.') }}</p></li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('3. Purpose of Data Processing') }}</h6>
            
            <p>{{ __('Personal data will be used to:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('Respond to inquiries and contact requests.') }}</p></li>
                <li><p>{{ __('Manage quote requests.') }}</p></li>
                <li><p>{{ __('Improve website performance through statistical analysis.') }}</p></li>
                <li><p>{{ __('Ensure site security.') }}</p></li>
                <li><p>{{ __('Marketing activities: We use personal data for marketing purposes, including:') }}
                    <ul class="list-decimal pl-12">
                        <li><p>{{ __('Email marketing: Sending newsletters, updates, and promotions related to our services.') }}</p></li>
                        <li><p>{{ __('Personalized advertising: Using data for targeted ad campaigns on platforms like Facebook Ads and Google Ads.') }}</p></li>
                    </ul>
                </p></li>
            </ul>
            <p>{{ __('Data will not be shared with third parties beyond these purposes.') }}</p>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('4. Use of Cookies') }}</h6>
            
            <p>{{ __('At Chibalancetherapies.com, we use cookies to:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('Enhance user experience.') }}</p></li>
                <li><p>{{ __('Conduct traffic analysis (Google Analytics).') }}</p></li>
                <li><p>{{ __('Personalize ads (for advertising campaigns on Facebook and Google).') }}</p></li>
            </ul>
            <p>{{ __('You can manage cookies from the initial banner or by configuring your browser settings.') }}</p>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('5. Legal Basis for Processing') }}</h6>
            <ul class="list-disc pl-12">
                <li><p>{{ __('Explicit user consent when subscribing to our newsletters or agreeing to receive personalized advertising.') }}</p></li>
                <li><p>{{ __('Compliance with legal obligations.') }}</p></li>
                <li><p>{{ __('Legitimate interests in improving our site and services.') }}</p></li>
            </ul>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('6. Data Retention') }}</h6>
            <p>{{ __('Personal data will be retained as long as necessary for the described purposes or until the user requests its deletion.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('7. User Rights') }}</h6>

            <p>{{ __('Users have the right to:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('Access their personal data.') }}</p></li>
                <li><p>{{ __('Correct inaccurate data.') }}</p></li>
                <li><p>{{ __('Request data deletion.') }}</p></li>
                <li><p>{{ __('Restrict processing.') }}</p></li>
                <li><p>{{ __('Withdraw granted consent.') }}</p></li>
            </ul>

            <p>{{ __('To exercise your rights, you can contact us at: ') }}<a href="mailto:chibalancetherapies@gmail.com">chibalancetherapies@gmail.com</a>.</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('8. Security Measures') }}</h6>

            <p>{{ __('The site is protected with:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('SSL certificate to encrypt communications.') }}</p></li>
                <li><p>{{ __('Storage on secure servers.') }}</p></li>
                <li><p>{{ __('Regular backups.') }}</p></li>
            </ul>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('9. Modifications') }}</h6>

            <p>{{ __('We reserve the right to update this Privacy Policy based on legal or technical changes. The last update date will appear at the beginning of the document.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('10. Contact') }}</h6>

            <p>{{ __('For inquiries or requests related to this policy, contact us at: ') }}<a href="mailto:chibalancetherapies@gmail.com">chibalancetherapies@gmail.com</a>.</p>
        </div>
    </div>
</x-app-layout>
