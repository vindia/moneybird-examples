<?php
# Include the Moneybird API PHP class
require_once('moneybird_php_api/Api.php');
# Setting for PHP 5.3+
date_default_timezone_set('Europe/Amsterdam');

# Connect with Moneybird
$account        = '';   // The <account_name> in <account_name>.moneybird.nl
$username       = '';   // Your Moneybird username (an e-mail address)
$password       = '';   // Your Moneybird password
$moneybird = new MoneyBirdApi($account, $username, $password);

# To create an invoice, we first need to get an existing contact, or create a new one
$contactId = '';
if(empty($contactId)) {
    # Set details for new contact
    $newContact = new MoneyBirdContact;
    $newContact->address1       = 'Rokin 75';
    $newContact->zipcode        = '1234 XY';
    $newContact->city           = 'Amsterdam';
    $newContact->company_name   = 'ACME Corp.';             // not required when using first_name && last_name
    $newContact->country        = 'Netherlands';
    $newContact->customer_id    = '123456';                 // your own (unique!) customer id, NOT the moneybird id
    $newContact->email          = 'john.doe@example.com';
    $newContact->first_name     = 'John';                   // not required when using company_name
    $newContact->last_name      = 'Doe';                    // not required when using company_name
    # Try to save new contact
    $contact = $moneybird->saveContact($newContact);
} else {
    $contact = $moneybird->getContact($contactId);
}

# Now that we have a contact, we can build and save the invoice
$invoice = new MoneybirdInvoice;

# An invoice contains one or more invoice lines
# If you need more lines, you can just add more elements of $line to the $lines array
$lines = array();
$line = new MoneybirdInvoiceLine;
$line->description  = 'Description of the product or service you provided';
$line->amount       = 1;            // The number of items or hours you delivered
$line->price        = 42;           // The price per item or per hour (total price is calculated by Moneybird!)
$line->tax          = 0.19;         // Tax percentage (0.0 if not applicable)
$lines[] = $line;

# Add the contact details to the invoice
$invoice->setContact($contact);

# Add your invoice lines to the invoice
$invoice->details = $lines;

# Save the invoice to Moneybird (as a draft, it's not send yet)
$savedInvoice = $moneybird->saveInvoice($invoice);

# Send the invoice via e-mail
# You don't need to use $sendInfo, if you omit it or set it to `null` Moneybird will use the defaults as a fallback 
# (i.e. $contact->email as the recipient and your default body message from your Moneybird settings)
$sendInfo = new MoneybirdInvoiceSendInformation('email', 'jane.doe@example.com', 'A different body message');

# Send It!
$moneybird->sendInvoice($savedInvoice, $sendInfo);