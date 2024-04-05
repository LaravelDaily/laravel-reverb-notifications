<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button id="triggerGlobalNotification"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Trigger Global Notification
                    </button>

                    <select id="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <button id="triggerPrivateNotification"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Trigger Private Notification
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Trigger the notification by sending a request to server
        document.getElementById('triggerGlobalNotification').addEventListener('click', function () {
            fetch('/trigger', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    type: 'public',
                    _token: '{{ csrf_token() }}',
                })
            })
        });

        // Trigger the notification by sending a request to server
        document.getElementById('triggerPrivateNotification').addEventListener('click', function () {
            fetch('/trigger', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    type: 'private',
                    _token: '{{ csrf_token() }}',
                    user_id: document.getElementById('user_id').value
                })
            })
        });

        window.addEventListener('DOMContentLoaded', function () {
            // Listen for private notification event
            window.Echo.private('App.Models.User.' + {{ auth()->id() }})
                .listen('TriggerPrivateNotificationEvent', (event) => {
                    Swal.fire({
                        title: "Private Notification",
                        text: event.message,
                        icon: "success"
                    });
                });

            // Listen for public notification event
            window.Echo.channel('notification')
                .listen('TriggerNotificationEvent', (event) => {
                    Swal.fire({
                        title: "Global Notification",
                        text: event.message,
                        icon: "success"
                    });
                });
        });
    </script>
</x-app-layout>
