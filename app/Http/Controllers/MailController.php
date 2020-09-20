<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
class MailController extends FrontendController
{
    public function showContactForm()
    {
        return view('pages.contact', $this->data);
    }

    public function sendMail(Request $request)
    {
        \Mail::send('pages.dynamic_mail_template',
            [
                'message_customer' => $request->get('mail_customer_message'),
                'firstName_customer' => $request->get('mail_customer_firstname'),
                'lastName_customer' => $request->get('mail_customer_lastname')
            ],
            function ($mail) use($request)
            {
                $mail -> from($request->get('mail_customer_email'));
                $mail -> to('aspict915@gmail.com') ->subject('Customer Enquiry');
            });
        return back()->with('message', 'Hvala što ste nas kontaktirali! Ubrzo ćemo odgovoriti');

    }
}