<?php

namespace App\Http\Controllers;

use App\LinkedOpusCard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LinkedOpusCardController extends Controller
{
    public function index()
    {
        $opus_cards = \App\LinkedOpusCard::get();
        return view('opus_cards', ['opus_cards' => $opus_cards]);
    }

    public function form()
    {
        return view('opus_card_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'traveller_name' => 'required',
            'traveller_email' => 'required|email',
            'opus_card_number' => 'required|integer',
            'opus_card_expiry_date' => 'required'
        ]);
        $traveller_name = $request->get('traveller_name');
        $traveller_email = $request->get('traveller_email');
        $opus_card_number = $request->get('opus_card_number');
        $opus_card_expiry_date = $request->get('opus_card_expiry_date');
        $account_email = Auth::user()->email;

        //validate data from stm api
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->request('GET', 'http://localhost/laravelApps/iGo/public/api/stm/opus_cards/email/' . $request->get('traveller_email'))->getBody()->getContents();
        if ($result) {
            $result = json_decode($result, true);
            if (!$result['linked_with_igo']) {
                $date1 = explode('-', $result['expiry_date']);
                $date2 = explode('-', $opus_card_expiry_date);
                if ($date1[0] == $date2[0] && ($date1[1] == $date2[2] || $date1[1] == $date2[1]) && ($date1[2] == $date2[1] || $date1[2] == $date2[2]) &&
                    $result['email'] == $traveller_email && $result['number'] == $opus_card_number) {
                    //save in igo db
                    $linked_opus_card = new LinkedOpusCard([
                        'name' => $traveller_name,
                        'number' => $opus_card_number,
                        'email' => $traveller_email,
                        'expiry_date' => $opus_card_expiry_date,
                        'account_email' => $account_email
                    ]);
                    $linked_opus_card->save();
                    //update stm igo 1350517757
                     $client->request('PUT', 'http://localhost/laravelApps/iGo/public/api/stm/opus_cards/'.$result['id'], ['form_params' =>
                         [
                             'number'=>$opus_card_number,
                             'email'=>$traveller_email,
                             'expiry_date'=>$result['expiry_date'],
                             'linked_with_igo' => true
                         ]]
                     );
                    //send confirmation email to all email ids
                    $this->sendOpusCardLinkSuccessMail();
                   // $this->sendOpusCardLinkSuccessMail($traveller_email);
                    return redirect('/linked_opus_cards')->with('success', 'Opus Card has been successfully linked with this account. Confirmation email has been sent to the main account holder email');

                } else {
//                    echo $date1[0]."=".$date2[0]."\n";
//                    echo $date1[1]."=".$date2[2]."\n";
//                    echo $date1[2]."=".$date2[1]."\n";
//                    echo $result['email']."=".$traveller_email."\n";
//                    echo $result['number']."=".$opus_card_number."\n";
                   return redirect('/linked_opus_cards')->with('error', 'Opus Card details are invalid! Please try again!');
                }

            } else {
                return redirect('/linked_opus_cards')->with('error', 'Opus Card is already linked with another account!');
            }
        } else {
            return redirect('/linked_opus_cards')->with('error', 'Opus Card details are invalid !');

        }

    }

    public function sendOpusCardLinkSuccessMail()
    {
        $data = array('name' => Auth::user()->getAuthIdentifierName());

        Mail::send('linkOpusMail', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->getAuthIdentifierName())
                ->subject('iGO- New Opus Card Linked with your Account');
            $message->from('igo.montreal.stm@gmail.com', 'iGo');
        });
    }
}
