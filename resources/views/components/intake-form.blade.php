<x-app-layout>
    <div class="intake_form">
        <x-icons.first_leave class="absolute pointer-events-none" />
        <x-icons.second_leave class="absolute pointer-events-none right-0 top-20 sm:top-28 z-10" />
        <div class="intake_form_hero">
            <h2>Intake Form</h3>
        </div>
        <div class="bg-blue_light py-12">
            <div class="container intake_form_content">
                <form id="intakeForm" action="{{ route('client.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input id="fullNameInput" type="text" name="full_name" placeholder="Your full name" required>
                            
                            <input id="ageInput" type="number" name="age" placeholder="Your age" required>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input id="phoneInput" type="tel" name="phone_number" placeholder="Your contact number" required pattern="[0-9]{9}">
                            
                            <input id="emergencyContactInput" type="tel" name="emergency_phone_number" placeholder="Emergency contact number" required pattern="[0-9]{9}">
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input id="townInput" type="text" name="town" placeholder="Town" required>
                            
                            <input id="occupancyInput" type="text" name="occupancy" placeholder="Occupancy" required>
                        </div>
                        
                        <input id="emailInput" type="email" name="email" placeholder="Your Email" required >
                    </div>
                    
                    <div class="flex flex-col gap-4">
                        <label for="treatment">Treatment booked</label>
                        <select name="treatment" id="treatmentInput">
                            <option value="" disabled selected>Select your booked treatment</option>
                            @foreach($products as $product)
                                <option value="{{ $product->title }}">{{ $product->title }}</option>
                            @endforeach
                        </select>

                        <div class="flex flex-col gap-10">
                            <div class="flex flex-col gap-2">
                                <label for="sore">Are you sore at the moment? Name where in your body and describe kind of pain and for how long are you feeling this</label>
                                <textarea id="soreInput" name="sore" rows="1" placeholder="Your answer" required ></textarea>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label for="medication">Any medications and other treatments done in the last 3 months? Name everyone, give details and duration please.</label>
                                <textarea id="medicationInput" name="medication" rows="1" placeholder="Your answer" required ></textarea>
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <label for="allergies">Any allergies?</label>
                                <textarea id="allergiesInput" name="allergies" rows="1" placeholder="Your answer" required ></textarea>
                            </div>
        
                            <div class="flex flex-col gap-2">
                                <label for="medicalBackground">Name major medical background to know in the last 6 months: eg, cancer, heart failure, epilepsy, diabetes, injuries, surgeries, peace-maker or metal prostheses in your body, contagious skin disease, undiagnosed lumps, sebaceous cysts, current infection, haemorrhage or any other thing which comes to your mind about your health situation. Please mention dates, duration and treatments you do to help.</label>
                                <textarea id="medicalBackgroundInput" name="medicalBackground" rows="1" placeholder="Your answer" required ></textarea>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <label for="sports">Exercises or sports</label>
                                <textarea id="sportsInput" name="sports" rows="1" placeholder="Your answer" required ></textarea>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center sm:text-center sm:justify-center lg:justify-around gap-4 sm:gap-16">
                                <div class="flex flex-col gap-4">
                                    <p class="text-base">Evaluate your current diet:</p>
                                    <div class="radio-container flex gap-4">
                                        <input type="radio" name="currentDiet" value="Poor" id="poorDietInput" class="peer hidden">
                                        <label for="poorDietInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Poor</label>
                                        
                                        <input type="radio" name="currentDiet" value="Average" id="averageDietInput" class="peer hidden">
                                        <label for="averageDietInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Average</label>
                                        
                                        <input type="radio" name="currentDiet" value="Very Good" id="veryGoodDietInput" class="peer hidden">
                                        <label for="veryGoodDietInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Very good</label>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-4">
                                    <p class="text-base">Sleep patterns:</p>
                                    <div class="radio-container flex gap-4">
                                        <input type="radio" name="sleepPatterns" value="Poor" id="sleepPatternsPoorInput" class="peer hidden">
                                        <label for="sleepPatternsPoorInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Poor</label>
                                        
                                        <input type="radio" name="sleepPatterns" value="Fine" id="sleepPatternsFineInput" class="peer hidden">
                                        <label for="sleepPatternsFineInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Fine</label>
                                        
                                        <input type="radio" name="sleepPatterns" value="Good" id="sleepPatternsGoodInput" class="peer hidden">
                                        <label for="sleepPatternsGoodInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Good</label>
                                    </div>                        
                                </div>
            
                                <div class="flex flex-col gap-4">
                                    <p class="text-base">Water Intake:</p>
                                    <div class="radio-container flex gap-4">
                                        <input type="radio" name="waterIntake" value="Half pint or less" id="waterIntakeHalfInput" class="peer hidden">
                                        <label for="waterIntakeHalfInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">Half pint or less</label>
                                        
                                        <input type="radio" name="waterIntake" value="One pint" id="waterIntakeOneInput" class="peer hidden">
                                        <label for="waterIntakeOneInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">One pint</label>
                                        
                                        <input type="radio" name="waterIntake" value="Two lts or more" id="waterIntakeTwoInput" class="peer hidden">
                                        <label for="waterIntakeTwoInput" class="block bg-slate-100 px-4 py-2 rounded-full text-xs dark:bg-dark_gray">2 lts or more</label>
                                    </div>
                                </div>
                            </div>
    
                        </div>    
                    </div>

                    <div class="flex flex-col gap-4">
                        <h5>Women only</h5>
    
                        <div class="flex flex-col gap-10">
                            <div class="flex flex-col gap-2">
                                <label for="pregnancy">If you are pregnant, mention pregnancy stage (weeks) and any medical considerations to know.</label>
                                <textarea id="pregnancyInput" name="pregnancy" rows="1" placeholder="Your answer" ></textarea>
                            </div>
        
                            <div class="flex flex-col gap-2">
                                <label for="menopause">If you are going through menopause or perimenopause please describe symptoms related and any treatments you are doing or HRT.</label>
                                <textarea id="menopauseInput" name="menopause" rows="1" placeholder="Your answer" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <h5>Consent notification:</h5>
                        <ul class="consent_list">
                            <li>By signing below, I agree to the following:<br>
                            I voluntarily request and consent to receiving a treatment from Chi Balance Therapies.</li>
                            <li>I understand that the treatment offered is for the purposes of general wellness, stress reduction, and relief of muscular tension only.</li>
                            <li>If I experience any pain or discomfort, I will immediately inform my therapist so that the pressure or techniques used can be adjusted to my comfort level. I will not hold my massage therapist responsible for any pain or discomfort I experience during or after the session.</li>
                            <li>I understand the risks associated with massage therapy include, but are not limited to: possible Short-term muscle soreness or Exacerbation of undiscovered injury.</li>
                            <li>I have been given the opportunity to ask questions about my treatment and my questions have been answered.</li>
                            <li>I have been advised of Information regarding massage in general, benefits, contraindications of massage, and possible alternative therapies have been explained to me. I further understand that massage therapy is not a substitute for a medical examination or treatment, and that I should see a physician or other qualified health specialist for any mental or physical ailment of which I am aware. I understand that massage therapists do not diagnose illness or disease, and nothing said during the massage should be construed as such. My consent is informed and voluntary and I understand that I may withdraw my consent at any time except for actions already taken.</li>
                        </ul>
    
                        <div class="flex items-start gap-2">
                            <input type="checkbox" id="signedCheckbox" name="signed" class="consentCheckbox" value="1" required>
                            <label for="signedCheckbox" class="text-sm">
                                By signing this form, I give my consent to proceed with the treatment as outlined above.
                            </label>
                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LeABugqAAAAAE1LHJ6QvpF6T3l4bXQ78eoWBdJK"></div>
                    <x-button id="subscribeBtn" type="submit" class="btn btn-primary" >
                        <span>{{__('Send')}}</span><x-icons.send-info />
                    </x-button>
                    <div id="loader_container" class="loader_container hidden_loader">
                    <div class="form_loader">
                        <div></div>
                        <div></div>
                    </div>
                    <span>{{__('Sending...')}}</span>
                </div>
                </form>
                <div id="successMessage" class="mx-auto" style="display: none;">
                    <H4 class="text-center">Form Sent!</H4>
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
    const form = document.getElementById('intakeForm');
    const subscribeBtn = document.getElementById('subscribeBtn');
    const signedCheckbox = document.getElementById('signedCheckbox');
    const loader = document.getElementById('loader_container');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    // Habilitar/deshabilitar botón de enviar según el estado de la casilla
    signedCheckbox.addEventListener('input', function() {
        subscribeBtn.disabled = !signedCheckbox.checked;
    });

    // Asegurarse de que el botón está inicialmente deshabilitado
    subscribeBtn.disabled = !signedCheckbox.checked;

    form.addEventListener('submit', async function(event) {
        event.preventDefault(); // Evitar el envío predeterminado del formulario

        subscribeBtn.style.display = 'none';
        loader.classList.remove('hidden_loader');

        // Usar FormData para capturar todos los datos del formulario
        const formData = new FormData(form);

        try {
            const response = await fetch('{{ route("client.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir el token CSRF en los headers
                },
                body: formData // Enviar el formulario como FormData
            });

            const data = await response.json();
            if (response.ok && data.success) {
                // Mostrar el mensaje de éxito
                successMessage.style.display = 'block';
                form.style.display = 'none';
            } else {
                // Mostrar mensaje de error si el envío falla
                errorMessage.style.display = 'block';
            }
        } catch (error) {
            // Mostrar mensaje de error en caso de error de red o cualquier otra excepción
            errorMessage.style.display = 'block';
        } finally {
            // Ocultar el loader cuando termine el proceso
            loader.classList.add('hidden_loader');
        }
    });
});

</script>