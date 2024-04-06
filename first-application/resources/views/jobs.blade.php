<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    
    @foreach ($jobs as $job)
        <li>
            <a href="/jobs/{{ $job['id'] }}">
                <b>{{ $job['title'] }}</b>: Pays {{ $job['salary'] }} per year.
            </a>
        </li>
    @endforeach

</x-layout>