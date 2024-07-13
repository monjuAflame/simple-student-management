<x-app-layout>
    @prepend('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <style>
            .select2-container {
                width: 100% !important;
                
            }
            .select2-container--default .select2-selection--multiple {
                background-color: rgb(17 24 39 / 1) !important;
                padding: 6px !important;
                border: 1px solid rgb(55 65 81 / 1) !important;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #3b454d !important;
                border: 1px solid #858585 !important;
                margin-top: 0px !important;
                
            }
        </style>
    @endprepend
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.courses').select2();
            });
        </script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Edit') }}
        </h2>
        
        <x-nav-link-button :href="route('courses.index')" >
            {{ __('Course List') }}
        </x-nav-link-button>
    </x-slot>

@session('error')
        <div class="p-4 bg-green-100">
            {{ $value }}
        </div>
@endsession

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')
                <div class="flex flex-col gap-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="grid grid-cols-2 gap-4">

                                <div class="mt-4 ">
                                    <x-input-label for="name" :value="__('Course Name')" class="after:content-['*'] after:ml-0.5 after:text-red-500" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $course->name)" required  autofocus autocomplete="name" placeholder="Course Name"/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="code" :value="__('Course Code')" />
                                    <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code', $course->code)" autofocus autocomplete="code" placeholder="Course Code"/>
                                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="fee" :value="__('Course Fee')" />
                                    <x-text-input id="fee" class="block mt-1 w-full" type="text" name="fee" :value="old('fee', $course->fee)" autofocus autocomplete="fee" required placeholder="Course Fee"/>
                                    <x-input-error :messages="$errors->get('fee')" class="mt-2" />
                                </div>

                            </div>
                        </div>
                    </div>
                 

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Update Course') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
