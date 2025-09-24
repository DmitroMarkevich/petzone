<?php

return [

    // GENERAL
    /*
     | Base URL NovaPoshta
     | @see https://developers.novaposhta.ua/
     */
    'base_uri' => 'https://api.novaposhta.ua/v2.0/',

    /*
     | End Point
     | @see https://developers.novaposhta.ua/
     |
     | Supported: "json"
     */
    'point' => env('NP_POINT', 'json'),

    'api_key' => env('NP_API_KEY', 'api_key'),

    /*
     | Debug mode for requests.
     | Adds full response body to the `dev` variable in the array.
     */
    'dev' => env('NP_DEV', false),

    /*
    | Default list limit.
    | Maximum value: 500 for all lists, 1500 for streets.
     */
    'page_limit' => 500,

    /*
    |---------------------------------------------------------------------------
    | Default values for parcel shipment
    |---------------------------------------------------------------------------
    |
    | Used for general shipments and to reduce code
    | when creating waybills
    |
    | Values are taken from the directories. Strictly according to Nova Poshta docs.
    */

    /*
    |---------------------------------------------------------------------------
    | Sender
    |---------------------------------------------------------------------------
    |
    | If there are multiple senders - specify one, others can be passed before saving
    |
    */

    /*
     | Default sender ID
     */
    'sender' => '5ace4a2e-13ee-11e5-add9-005056887b8d',

    /*
    | Default sender city ID
    */
    'city_sender' => '8d5a980d-391c-11dd-90d9-001a92567626',

    /*
    | Default sender address ID
    */
    'sender_address' => 'd492290b-55f2-11e5-ad08-005056801333',

    /*
    | Default sender contact person ID
    */
    'contact_sender' => '613b77c4-1411-11e5-ad08-005056801333',

    /*
    | Sender phone in format: +380660000000, 380660000000, 0660000000 by default
    */
    'senders_phone' => '380991234567',

    /*
    | @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/f74a0918-8f18-11ec-8ced-005056b2dbe1
    |
    | 'PrivatePerson', 'Organization'
    */
    'recipient_type' => 'PrivatePerson',

    /*
    | Default ServiceType
    |
    | 'DoorsDoors', 'DoorsWarehouse', 'WarehouseWarehouse', 'WarehouseDoors'
    */
    'service_type' => 'WarehouseWarehouse',

    /*
    | Default CargoType
    |
    | 'Cargo', 'Documents', 'TiresWheels', 'Pallet', 'Parcel'
    */
    'cargo_type' => 'Parcel',

    /*
    | Default PaymentMethod
    |
    | 'Cash', 'NonCash'
    */
    'payment_method' => 'Cash',

    /*
    | Default PayerType
    |
    | 'Sender', 'Recipient', 'ThirdPerson'
    */
    'payer_type' => 'Recipient',

    /*
    | Default PayerType for BackwardDeliveryData
    | Sender - sender pays for return documents/money
    | Recipient - recipient pays for return documents/money
    | Third person CANNOT be a payer
    |
    | 'Sender', 'Recipient'
    */
    'back_delivery_payer_type' => 'Recipient',

    /*
    | Default Description (parcel description)
    */
    'description' => 'Товары',

    /*
    | Integer, default number of shipment seats
    */
    'seats_amount' => 1,

    /*
    | Integer, default declared cost
    */
    'cost' => 300,

    /*
    | Default parcel weight
    */
    'weight' => 1,

    /*
    | Default cargo parameters
    |
    | Array of boxes for quick volumetric cargo selection
    | Volumetric weight (kg) = (Length(cm) × Width(cm) × Height(cm)) / 4000
    | If value not from array - default 1kg
    */
    'options_seat' => [
        // ...
    ],

    /*
    | http_response_timeout - max seconds to wait for response
    | http_retry_max_time - max number of request attempts
    | http_retry_delay - milliseconds Laravel waits between attempts
    */
    'http_response_timeout' => 3,
    'http_retry_max_time' => 2,
    'http_retry_delay' => 500,

    /*
    | Default return ID
    | ref_return_reasons - "Delivery refusal"
    | ref_return_reasons_sub - "Shipment does not match order, not suitable"
    */
    'ref_return_reasons' => '49754eb2-a9e1-11e3-9fa0-0050568002cf',
    'ref_return_reasons_sub' => '49754ec8-a9e1-11e3-9fa0-0050568002cf',

    /*
    | Default return warehouse Ref
    | Ref from warehouse directory
    | Kyiv-30 - '4049833d-e1c2-11e3-8c4a-0050568002cf'
    */
    'ref_return_warehouse' => '',

    /*
    | Default note for returns and redirections
    */
    'return_note' => 'Parcel return',
    'redirecting_note' => 'Parcel redirection',

    /*
    | Default return payment format Cash/NonCash
    */
    'return_cash_method' => 'Cash',

    /*
    | Default payment method for storage extension Cash/NonCash
    */
    'term_payment_method' => 'Cash',

    /*
    | Default print format
    | Document_new, Marking_85x85, Marking_100x100
    */
    'print_form' => 'Marking_100x100',

    /*
    | Default PDF registry orientation
    | 'portrait' or 'landscape'
    */
    'scan_sheet_orientation' => 'portrait',

];
