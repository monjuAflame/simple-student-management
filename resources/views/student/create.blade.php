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
            {{ __('Student Create') }}
        </h2>
        
        <x-nav-link-button :href="route('students.index')" >
            {{ __('Student List') }}
        </x-nav-link-button>
    </x-slot>

@session('error')
        <div class="p-4 bg-green-100">
            {{ $value }}
        </div>
@endsession

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('students.store') }}">
            @csrf
                <div class="flex flex-col gap-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="grid grid-cols-2 gap-4">

                                <!-- First Name -->
                                <div class="mt-4 ">
                                    <x-input-label for="first_name" :value="__('First Name')" class="after:content-['*'] after:ml-0.5 after:text-red-500" />
                                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required  autofocus autocomplete="first_name" placeholder="First Name"/>
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <!-- Last Name -->
                                <div class="mt-4">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('name')" autofocus autocomplete="last_name" placeholder="First Name"/>
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <!-- Phone -->
                                <div class=" mt-4">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" placeholder="Phone Number" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Here" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2"  />
                                </div>

                                <!-- select course -->
                                <div class="mt-4">
                                    <x-input-label for="course" :value="__('Course')" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                   
                                    <select class="courses" name="course_id[]" id="course" multiple="multiple">
                                        @foreach ($courses as $item)
                                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                        
                                    <x-input-error :messages="$errors->get('course_id')" class="mt-2"  />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Gender -->
                                    <div class=" mt-4">
                                        <x-input-label :value="__('Gender')" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                        <fieldset class="mt-4 flex items-center gap-5">
                                        
                                            <div class="flex items-center mb-4 gap-1">
                                                <input id="male" type="radio" name="gender" value="male" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"  checked="">
                                                <label for="male" class="text-sm font-medium text-white ml-2 block">
                                                Male
                                                </label>
                                            </div>

                                            <div class="flex items-center mb-4 gap-1">
                                                <input id="female" type="radio" name="gender" value="female" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"  checked="">
                                                <label for="female" class="text-sm font-medium text-white ml-2 block">
                                                Female
                                                </label>
                                            </div>
                                        </fieldset>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2"  />

                                    </div>

                                    <!-- dob  -->
                                    <div class=" mt-4">
                                        <x-input-label for="dob" :value="__('Date of Birth')"/>
                                        <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" autocomplete="dob" />
                                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="mt-4 col-span-2">
                                    <x-input-label for="address" :value="__('Address')" />
                                    <textarea name="address" id="address" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address..">{{ old('address') }}</textarea>
                                    
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="grid grid-cols-2 gap-4">

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" placeholder="Password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                 

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Create Student') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
