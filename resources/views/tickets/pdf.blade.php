<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Invoice</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen align-center bg-gray-100 ">
        <div class="object-scale-down">
            Nome: {{ $user ? $user->name : 'N/A' }}
            <br>
            <img class="h-20 mt-5 rounded-full" src="{{ $user && $user->photo_filename ? asset('storage/photos/' . $user->photo_filename) : asset('storage/photos/default.png') }}">
        </div>
        <div class="w-3/5 bg-white shadow-lg">
            <div class="flex justify-center p-4">
                <div class="border-b border-gray-200 shadow">
                    <p class="px-6 py-4 text-sm text-gray-500">
                        Id do bilhete: {{ $ticket->id }}
                    </p>
                    <p class="px-6 py-4 text-sm text-gray-500">
                        Filme: {{ $movie->title }}
                    </p>
                    <p class="px-6 py-4">
                        Sala: {{ $theater->name }}
                    </p>
                    <p class="px-6 py-4 text-sm text-gray-500">
                        Data: {{ $purchase->date }}
                    </p>
                    <p class="px-6 py-4 text-sm text-gray-500">
                        Horario: {{ $screening->start_time }}
                    </p>
                    <p class="px-6 py-4 text-sm text-gray-500">
                        Lugar: {{ $seat->row }}-{{ $seat->seat_number }}
                    </p>
                    <div class="px-6 py-4">
                        {!! QrCode::size(200)->generate(route('tickets.show', ['ticket' => $ticket->id])) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
