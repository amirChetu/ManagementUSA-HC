<?php

namespace App\Http\Controllers;

/**
 * This class is used for Docu Sign functionality
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Dcoumentsign extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Make base URL with the docusign authorization
     * @return $user Authorization
     */
    public function baseurl() {
        $templateId = "1a518d2a-a3bb-4066-9cc2-724f9ac5d68b";
        $envelopeId = "1a518d2a-a3bb-4066-9cc2-724f9ac5d68b";
        $userId = "d78c6531-c3bd-46ce-ae9a-0b896d668e06";
        $folderId = "b4a0aa43-5cc6-4d16-bd1e-6ba269a2a4d4";


        $envelope = \Docusign::getEnvelope($envelopeId);
        $envelopeId = $envelope['envelopeId'];
        $envRecipients = \Docusign::getEnvelopeRecipients($envelopeId, true);

        $users = \Docusign::createRecipientView($envelopeId, array(
                    'userName' => 'amir hanga',
                    'email' => 'amirh@chetu.com',
                    'AuthenticationMethod' => 'email',
                    'clientUserId' => "d78c6531-c3bd-46ce-ae9a-0b896d668e06", // Must create envelope with this ID
                    'returnUrl' => 'http://azmensclinic.chetu.com/'
        ));
    }

}
