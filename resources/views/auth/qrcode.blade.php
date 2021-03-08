<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="lg:block h-20 w-auto" src="{{asset('ryperlab/img/logo.png')}}" alt="Workflow">
            </a>
        </x-slot>

        <!-- Session Status -->
        <div style="width: auto" id="reader"></div>
    </x-auth-card>
</x-guest-layout>
