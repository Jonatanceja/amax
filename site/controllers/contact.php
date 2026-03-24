<?php

return function ($kirby, $page) {
    $success = false;
    $error = false;

    if ($kirby->request()->is('POST') && get('contact_form')) {
        $data = [
            'name'    => get('name'),
            'email'   => get('email'),
            'phone'   => get('phone'),
            'service' => get('service'),
            'message' => get('message'),
        ];

        $rules = [
            'name'    => ['required', 'minLength' => 2],
            'email'   => ['required', 'email'],
            'service' => ['required'],
        ];

        $messages = [
            'name'    => 'Please enter your name.',
            'email'   => 'Please enter a valid email.',
            'service' => 'Please select a service.',
        ];

        if ($invalid = invalid($data, $rules, $messages)) {
            $error = implode('<br>', $invalid);
        } else {
            try {
                $kirby->email([
                    'from'     => 'noreply@amaxcontractors.com',
                    'replyTo'  => $data['email'],
                    'to'       => $kirby->site()->email()->value(),
                    'subject'  => 'New quote request from ' . $data['name'],
                    'body'     => [
                        'text' => 'Name: ' . $data['name'] . "\n" .
                                  'Email: ' . $data['email'] . "\n" .
                                  'Phone: ' . ($data['phone'] ?: 'Not provided') . "\n" .
                                  'Service: ' . $data['service'] . "\n\n" .
                                  'Message:' . "\n" . ($data['message'] ?: 'No message provided'),
                    ],
                ]);

                $success = true;
                $data = [];
            } catch (Exception $e) {
                $error = 'The form could not be sent. Please try again or contact us directly.';
            }
        }
    }

    return [
        'success' => $success,
        'error'   => $error,
        'data'    => $data ?? [],
    ];
};
