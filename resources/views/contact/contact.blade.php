<x-app-layout>
    <div class="contact_form">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-20 sm:top-28 z-10" />
        <div class="contact_form_hero">
            <h2>Contact Form</h3>
        </div>
        <div class="bg-blue_light py-12">
            <div class="container contact_form_content">
                <form id="contactForm" action="{{ route('contact.store') }}" method="post" class="flex gap-2 w-full form">
                    @csrf
                    <div class="flex flex-col gap-6 w-full">
                        <input id="nameInput" type="text" name="name" placeholder="Su nombre" required>
                        <input id="emailInput" type="email" name="email" placeholder="Su correo electrónico" required>
                        <input id="phoneInput" type="tel" name="phone" placeholder="Su teléfono" required pattern="[0-9]{9}">
                        <label for="treatment">Treatment</label>
                            <select name="treatment" id="treatmentInput">
                                <option value="" disabled selected>Select a treatment</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->title }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        <textarea id="messageInput" name="message" placeholder="Déjenos un mensaje" rows="4" required></textarea>
                        
                        <!-- Casilla de verificación para Términos y Política -->
                        <div class="flex items-start gap-2">
                            <input type="checkbox" id="termsCheckbox" name="terms" required>
                            <label for="termsCheckbox" class="text-sm">
                                I have read and accept
                                <a href="/terminos-y-condiciones" target="_blank" class="underline">the Terms and Conditions</a> and the
                                <a href="/politica-de-privacidad" target="_blank" class="underline">Privacy Policy</a>.
                            </label>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6LfVW4kqAAAAAEdYw7ib6b04hXWw1e5IC2HBqsSR"></div>

                        <x-button id="subscribeBtn" type="submit" disabled class="btn btn-primary" >
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

        form.addEventListener('submit', async function(event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario

            subscribeBtn.style.display = 'none';
            loader.classList.remove('hidden_loader');

            const name = document.getElementById('nameInput').value;
            const email = document.getElementById('emailInput').value;
            const phone = document.getElementById('phoneInput').value;
            const treatment = document.getElementById('treatmentInput').value;
            const message = document.getElementById('messageInput').value;

            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, email, phone, treatment, message })
                });
                const data = await response.json();
                if (response.ok) {
                    successMessage.style.display = 'block';
                    form.style.display = 'none';
                } else {
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                errorMessage.style.display = 'block';
            } finally {
                loader.classList.add('hidden_loader');
            }
        });
    });
</script>
