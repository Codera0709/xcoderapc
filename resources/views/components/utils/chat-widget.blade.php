@props([
    'name' => 'chat-widget',
    'show' => false,
    'agentName' => 'Support',
    'agentStatus' => 'online', // online, offline, away
])

<div
    x-data="{
        show: @js($show),
        messages: [],
        newMessage: '',
        agentStatus: '{{ $agentStatus }}',
        init() {
            // Sample initial messages
            this.messages = [
                { text: 'Hello! How can I help you today?', sender: 'agent', time: '10:00 AM' },
                { text: 'I have a question about my account', sender: 'user', time: '10:01 AM' },
            ];
        },
        sendMessage() {
            if (this.newMessage.trim() !== '') {
                this.messages.push({
                    text: this.newMessage,
                    sender: 'user',
                    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                });
                
                // Simulate agent response after a delay
                setTimeout(() => {
                    this.messages.push({
                        text: 'Thanks for your message. I\'ll look into this for you.',
                        sender: 'agent',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                    });
                }, 1000);
                
                this.newMessage = '';
            }
        }
    }"
    class="fixed bottom-6 right-6 z-50"
>
    <!-- Chat Widget Toggle Button -->
    <button 
        @click="show = !show"
        class="p-3 rounded-full bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center relative"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        
        <!-- Status indicator -->
        <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span 
                class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                :class="{
                    'bg-green-400': agentStatus === 'online',
                    'bg-yellow-400': agentStatus === 'away',
                    'bg-gray-400': agentStatus === 'offline'
                }"
            ></span>
            <span 
                class="relative inline-flex rounded-full h-3 w-3"
                :class="{
                    'bg-green-500': agentStatus === 'online',
                    'bg-yellow-500': agentStatus === 'away',
                    'bg-gray-500': agentStatus === 'offline'
                }"
            ></span>
        </span>
    </button>

    <!-- Chat Window -->
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="transform opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="transform opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="transform opacity-0 translate-y-2 scale-95"
        class="absolute bottom-16 right-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
    >
        <!-- Chat Header -->
        <div class="bg-indigo-600 text-white p-4 flex items-center justify-between">
            <div class="flex items-center">
                <x-utils.avatar :name="$agentName" size="sm" class="mr-2" />
                <div>
                    <h3 class="font-medium">{{ $agentName }}</h3>
                    <p class="text-xs opacity-80 capitalize" x-text="agentStatus"></p>
                </div>
            </div>
            <button @click="show = false" class="text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div class="h-80 overflow-y-auto p-4 bg-gray-50 dark:bg-gray-900">
            <template x-for="message in messages" :key="$index">
                <div 
                    class="mb-4 flex"
                    :class="message.sender === 'user' ? 'justify-end' : 'justify-start'"
                >
                    <div 
                        class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg"
                        :class="{
                            'bg-indigo-500 text-white rounded-tr-none': message.sender === 'user',
                            'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-tl-none': message.sender === 'agent'
                        }"
                    >
                        <p x-text="message.text"></p>
                        <p 
                            class="text-xs mt-1 opacity-70"
                            :class="{
                                'text-indigo-200': message.sender === 'user',
                                'text-gray-500 dark:text-gray-400': message.sender === 'agent'
                            }"
                        >
                            <span x-text="message.time"></span>
                        </p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Chat Input -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-3 bg-white dark:bg-gray-800">
            <div class="flex items-center">
                <input
                    x-model="newMessage"
                    @keydown.enter.prevent="sendMessage"
                    type="text"
                    placeholder="Type a message..."
                    class="flex-1 border border-gray-300 dark:border-gray-600 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                />
                <button 
                    @click="sendMessage"
                    :disabled="!newMessage.trim()"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>