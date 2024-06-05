<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{$job->title}}</h2>
    <p>
        This jobs pays {{$job->salary}} per year.
    </p>
    <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button>
</x-layout>