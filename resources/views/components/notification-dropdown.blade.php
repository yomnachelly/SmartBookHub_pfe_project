@php
    $notifications = Auth::user()->unreadNotifications ?? collect();
    $notificationCount = $notifications->count();
@endphp

<div x-data="{ open: false }" class="relative">
    <!-- Notification Bell -->
    <button @click="open = !open" 
        class="relative p-2 text-white hover:text-[#FFC62A] focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        
        @if($notificationCount > 0)
        <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-400"></span>
        @endif
    </button>

    <!-- Dropdown -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 border border-gray-200">
        
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
            @if($notificationCount > 0)
                <p class="text-xs text-gray-500 mt-1">{{ $notificationCount }} notification(s) non lue(s)</p>
            @endif
        </div>

        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto">
            @if($notifications->isEmpty())
                <div class="px-4 py-6 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Aucune notification</p>
                </div>
            @else
                @foreach($notifications as $notification)
                    <a href="{{ $notification->data['url'] ?? '#' }}" 
                       class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-b-0"
                       onclick="markAsRead('{{ $notification->id }}')">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                @if(str_contains($notification->data['message'] ?? '', 'acceptée'))
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-900">
                                    {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        <!-- Footer -->
        @if($notificationCount > 0)
            <div class="px-4 py-3 border-t border-gray-200">
                <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full text-center text-sm text-blue-600 hover:text-blue-800">
                        Marquer toutes comme lues
                    </button>
                </form>
                <a href="{{ route('notifications.index') }}" 
                   class="block mt-2 text-center text-sm text-gray-600 hover:text-gray-800">
                    Voir toutes les notifications
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/mark-as-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    });
}
</script>