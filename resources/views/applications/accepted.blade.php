<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Accepted Applications</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($applications as $application)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $application->job->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $application->job->company }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-600 font-semibold">Accepted</span>
                        <span class="text-blue-600 font-semibold">${{ $application->job->salary }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
