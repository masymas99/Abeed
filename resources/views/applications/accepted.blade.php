{{-- <x-app-layout>
 --}}    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Accepted Applications</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
{{--            @dd($applications)
 --}}             @foreach($applications as $application)
{{--                     @dd($application->resume)
 --}}             <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">


                    <p><strong>Resume:</strong> {{ $application->resume }}</p>
        <p><strong>Contact Email:</strong> {{ $application->contact_email }}</p>
        <p><strong>Contact Phone:</strong> {{ $application->contact_phone ?? 'Not provided' }}</p>
        <p><strong>Status:</strong> {{ $application->status }}</p>

        <h3>Job Listing Details:</h3>
        <p><strong>Title:</strong> {{ $application->jobListing->title }}</p>
        <p><strong>Location:</strong> {{ $application->jobListing->location }}</p>
        <p><strong>Salary Range:</strong> {{ $application->jobListing->salary_min }} - {{ $application->jobListing->salary_max }}</p>
        <p><strong>Job Description:</strong> {{ $application->jobListing->description }}</p>
                   {{--  <h2 class="text-xl font-semibold mb-2">{{ $application->JobListings->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $application->location }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-600 font-semibold">Accepted</span>
                        <span class="text-blue-600 font-semibold">${{ $application->salary  }}</span> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
{{-- </x-app-layout>
 --}}
