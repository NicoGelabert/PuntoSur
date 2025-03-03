<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Events\ContactCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;
use App\Mail\AdminNotificationMail;

class ContactController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('contact.contact', ['products' => $products]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'treatment' => 'nullable|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
        ]);

        // Validar reCAPTCHA con Google
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY'); // Guarda la clave en el archivo .env

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
        ]);

        $responseData = $response->json();

        if (!$responseData['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA validation failed.'])->withInput();
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'treatment' => $request->treatment,
            'message' => $request->message,
        ]);

        try {
            // Send confirmation email to the subscriber
            Mail::to($contact->email)->send(new ContactConfirmation($contact));
            Mail::to(config('mail.from.address'))->send(new AdminNotificationMail($contact));

            return response()->json(['message' => 'Mensaje Enviado!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Falló el envío. Por favor intente en unos minutos.'], 500);
        }
    }
}
