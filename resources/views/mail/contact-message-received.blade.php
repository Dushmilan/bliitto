New contact message from {{ $contactMessage->name }}

From: {{ $contactMessage->name }} <{{ $contactMessage->email }}>
Received: {{ $contactMessage->created_at->toDayDateTimeString() }}

{{ $contactMessage->message }}
