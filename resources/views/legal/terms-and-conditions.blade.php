<x-app-layout>
    <div class="flex flex-col justify-center gap-12 max-w-screen-xl px-4 py-32 mx-auto md:px-16 overflow-hidden">
        <h3>{{ __('Terms and Conditions') }}</h3>
        <p>{{ __('Last updated: February, 2025') }}</p>

        <div class="flex flex-col gap-4">
            <h6>{{ __('1. Introduction') }}</h6>

            <p>{{ __('Welcome to chibalancetherapies.com. By accessing or using this website, you agree to comply with these terms and conditions. If you do not agree with any part of the terms, do not use this site.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('2. Website Owner Information') }}</h6>
            
            <p>{{ __('This website is operated by Chi Balance Therapies, a company specializing in holistic wellness and therapy services. For any inquiries, you can contact us at ') }}<a href="mailto:chibalancetherapies@gmail.com">chibalancetherapies@gmail.com</a>.</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('3. Use of the Website') }}</h6>
            
            <p>{{ __('This site is intended for users seeking information about our services and offerings.') }}</p>

            <p>{{ __('The following is prohibited:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('Using the site for illegal or unauthorized activities.') }}</p></li>
                <li><p>{{ __('Attempting to damage, overload, or disable the website.') }}</p></li>
                <li><p>{{ __('Copying, distributing, or modifying any content without our consent.') }}</p></li>
            </ul>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('4. Intellectual Property') }}</h6>
            
            <p>{{ __('All content on the site (designs, texts, images, logos, etc.) is the property of Chi Balance Therapies or its licensors and is protected by intellectual property laws.') }}</p>

            <p>{{ __('Unauthorized use is prohibited.') }}</p>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('5. Forms and Personal Data') }}</h6>

            <p>{{ __('By using contact or inquiry forms, you agree to provide truthful and complete information.') }}</p>

            <p>{{ __('The collected data will be processed in accordance with our ') }}<a href="/privacy-policy">{{ __('Privacy Policy') }}</a>.</p>

            <p>{{ __('Reading and accepting the privacy policy is mandatory before submitting any form.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('6. Use of Cookies') }}</h6>

            <p>{{ __('We use cookies to enhance user experience, conduct statistical analysis, and personalize advertisements. You can manage your preferences in our cookie banner.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('7. Limitation of Liability') }}</h6>

            <p>{{ __('Although we strive to keep the site information updated, we do not guarantee the accuracy or completeness of the content.') }}</p>

            <p>{{ __('We are not responsible for damages arising from the use of the site, such as:') }}</p>

            <ul class="list-disc pl-12">
                <li><p>{{ __('Service interruptions.') }}</p></li>
                <li><p>{{ __('Errors in the provided information.') }}</p></li>
                <li><p>{{ __('Technical issues beyond our control.') }}</p></li>
            </ul>
        </div>
        
        <div class="flex flex-col gap-4">
            <h6>{{ __('8. Modifications') }}</h6>

            <p>{{ __('We reserve the right to update these terms at any time. The date of the last modification will be indicated at the beginning of the document. We recommend reviewing them periodically.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('9. Applicable Law') }}</h6>

            <p>{{ __('These terms are governed by the laws of Spain. Any dispute related to the site will be subject to the jurisdiction of Spanish courts.') }}</p>
        </div>

        <div class="flex flex-col gap-4">
            <h6>{{ __('10. Contact') }}</h6>

            <p>{{ __('For any inquiries about these terms, you can contact us at ') }}<a href="mailto:chibalancetherapies@gmail.com">chibalancetherapies@gmail.com</a>.</p>
        </div>
    </div>
</x-app-layout>