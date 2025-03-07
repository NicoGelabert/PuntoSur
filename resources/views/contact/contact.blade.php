<x-app-layout>
    <div class="contact_form">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-20 sm:top-28 z-10" />
        <div class="contact_form_hero">
            <h2>Contact Form</h2>
        </div>
        <div class="bg-blue_light py-12">
            <div class="container max-w-xl contact_form_content">
                <form id="contactForm" class="flex gap-2 w-full form">
                    @csrf
                    <div class="flex flex-col gap-6 w-full">
                        <input id="nameInput" type="text" name="name" placeholder="Your full name" required>
                        <input id="emailInput" type="email" name="email" placeholder="Your Email" required>
                        <input id="phoneInput" type="tel" name="phone" placeholder="Your Phone" required pattern="[0-9]{9,10}">
                        
                        <select name="treatment" id="treatmentInput" required>
                            <option value="" disabled selected>Select a treatment</option>
                            @foreach($products as $product)
                                <option value="{{ $product->title }}">{{ $product->title }}</option>
                            @endforeach
                        </select>

                        <textarea id="messageInput" name="message" placeholder="Leave a message" rows="4" required></textarea>
                        
                        <!-- Casilla de verificación para Términos y Política -->
                        <div class="flex items-start gap-2">
                            <input type="checkbox" id="termsCheckbox" name="terms" required>
                            <label for="termsCheckbox" class="text-sm">
                                I have read and accept
                                <a href="/terminos-y-condiciones" target="_blank" class="underline">the Terms and Conditions</a> and the
                                <a href="/politica-de-privacidad" target="_blank" class="underline">Privacy Policy</a>.
                            </label>
                        </div>

                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                        <x-button id="subscribeBtn" type="submit" disabled class="btn btn-primary">
                            <span>{{__('Send')}}</span><x-icons.send-info />
                        </x-button>

                        <div id="loader_container" class="loader_container hidden_loader">
                            <div class="form_loader">
                                <div></div>
                                <div></div>
                            </div>
                            <span>{{__('Sending...')}}</span>
                        </div>
                    </div>
                </form>

                <div id="successMessage" class="mx-auto" style="display: none;">
                    <h4 class="text-center">Message Sent!</h4>
                </div>

                <div id="errorMessage" class="mx-auto" style="display: none;">
                    Submission failed. Please try again.
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const subscribeBtn = document.getElementById('subscribeBtn');
        const termsCheckbox = document.getElementById('termsCheckbox');
        const loader = document.getElementById('loader_container');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');

        // Habilitar/deshabilitar botón de enviar según el estado de la casilla
        termsCheckbox.addEventListener('change', function() {
            subscribeBtn.disabled = !termsCheckbox.checked;
        });

        // Asegurarse de que el botón esté inicialmente deshabilitado
        subscribeBtn.disabled = !termsCheckbox.checked;

        form.addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario
            subscribeBtn.style.display = 'none';
            loader.classList.remove('hidden_loader');

            // Usar FormData para capturar todos los datos del formulario
            const formData = new FormData(form);

    // Obtener el token de reCAPTCHA (reemplazar execute con getResponse)
    const recaptchaToken = grecaptcha.getResponse();

    if (!recaptchaToken) {
        errorMessage.textContent = 'Please verify that you are not a robot.';
        errorMessage.style.display = 'block';
        loader.classList.add('hidden_loader');
        return; // Si el reCAPTCHA no se ha completado, evita enviar el formulario
    }

    // Añadir el token de reCAPTCHA a FormData
    formData.append('g-recaptcha-response', recaptchaToken);

            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData // Enviar FormData al backend
                });

                const data = await response.json();
                if (response.ok) {
                    successMessage.style.display = 'block';
                    form.style.display = 'none';
                } else {
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                console.error('Error al enviar la solicitud:', error);
                errorMessage.style.display = 'block';
            } finally {
                loader.classList.add('hidden_loader');
            }
        });
    });
</script>
