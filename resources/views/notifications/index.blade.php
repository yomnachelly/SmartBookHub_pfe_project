@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Mes Notifications</h1>
            <p class="text-gray-600 mt-2">Historique de toutes vos notifications</p>
        </div>

        <!-- Mark all as read button -->
        @if(Auth::user()->unreadNotifications->count() > 0)
        <div class="mb-6">
            <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Marquer toutes comme lues
                </button>
            </form>
        </div>
        @endif

        <!-- Notifications List -->
        <div class="bg-white rounded-lg shadow">
            @if($notifications = Auth::user()->notifications()->paginate(20))
                @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                        <div class="border-b border-gray-200 last:border-b-0">
                            <a href="{{ $notification->data['url'] ?? '#' }}" 
                               class="block px-6 py-4 hover:bg-gray-50 {{ $notification->read() ? 'bg-gray-50' : 'bg-white' }}">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if(str_contains($notification->data['message'] ?? '', 'acceptée'))
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $notification->data['message'] ?? 'Notification' }}
                                            </p>
                                            @if(!$notification->read())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    Nouveau
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $notification->created_at->format('d/m/Y H:i') }}
                                            • {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune notification</h3>
                        <p class="mt-1 text-gray-500">Vous n'avez pas encore de notifications.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection