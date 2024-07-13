<x-app-layout>
    @prepend('scripts')
       
    @endprepend
    @push('scripts')
        
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Details') }}
        </h2>
        
        <x-nav-link-button :href="route('students.index')" >
            {{ __('Student List') }}
        </x-nav-link-button>
    </x-slot>

@session('error')
        <div class="p-4 red-green-100">
            {{ $value }}
        </div>
@endsession
@session('message')
    <div class="p-4 bg-green-100">
        {{ $value }}
    </div>
@endsession

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex flex-col gap-4">
                <div class="md:flex no-wrap md:-mx-2 overflow-y-scroll h-screen">
                    <div class="w-full md:w-3/12 md:mx-2">
                        <div class=" p-3 dark:text-white  dark:bg-gray-800 rounded-md">
                            <div class="image overflow-hidden">
                                <img class="h-auto w-full mx-auto"
                                    src=""
                                    alt="">
                            </div>
                            <h1 class=" font-bold text-xl leading-8 my-1 pl-2">
                                {{ $student->fullName }}
                            </h1>
                            
                            <ul
                                class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-white  py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                            class="{{ $student->user->status==1 ? 'bg-green-500' : 'bg-red-500' }}  py-1 px-2 rounded text-white text-sm">{{ $student->user->status==1 ? 'Active' : 'Deactive' }}</span></span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span class="ml-auto">{{ date('d-m-Y', strtotime($student->created_at)) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full md:w-9/12 mx-2 h-64 ">
                        <div class="dark:text-white  dark:bg-gray-800 p-3 shadow-sm rounded-md">
                            <div class="flex items-center space-x-2 font-semibold dark:text-white text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">About</span>
                            </div>
                            <div class="dark:text-white text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">First Name</div>
                                        <div class="px-4 py-2">{{ $student->user->first_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Last Name</div>
                                        <div class="px-4 py-2">{{ $student->user->last_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Gender</div>
                                        <div class="px-4 py-2">{{ ucfirst($student->gender) }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Phone</div>
                                        <div class="px-4 py-2">{{ $student->user->phone }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Email</div>
                                        <div class="px-4 py-2">
                                            <a class="text-blue-800" href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a>
                                            </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Date of Birth</div>
                                        <div class="px-4 py-2">
                                            {{ date('d-m-Y', strtotime($student->dob)) }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold dark:text-gray-400">Address</div>
                                        <div class="px-4 py-2">
                                            {{ $student->address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-4"></div>
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="text-gray-900 dark:text-gray-100">Enroll {{ count($student->user->enrolments) }} Courses</h2>
                                <div class="flex flex-col gap-y-4 dark:bg-gray-900 mt-4 p-6 rounded-md">
                                    @foreach ($student->user->enrolments as $item)
                                        <div class="flex gap-x-5">
                                            <span class="dark:text-gray-400 font-bold">{{ $item->course->name }}</span>
                                            <span class="dark:text-gray-400">Due: <b>{{ $item->payment->due }}</b></span>
                                            
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                        <div class="py-4"></div>
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                
                                <h2 class="text-gray-900 dark:text-gray-100">Payments</h2>
                                <div class="flex flex-col gap-4 mt-2">
                                    @forelse ($student->user->enrolments as $key => $item)
                                        <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-6 rounded-lg" >
                                            <summary class="text-sm leading-6 text-slate-900 dark:text-gray-400 select-none">
                                                <div class="flex justify-between mt-2">
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">ID</span>
                                                        <span class="px-3 py-1.5">{{ $loop->iteration }}</span>
                                                    </div>
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">Course Name</span>
                                                        <span class="px-3 py-1.5">{{ $item->course->name }}</span>
                                                    </div>
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">Course Fee</span>
                                                        <span class="px-3 py-1.5">{{ $item->payment->course_fee }}</span>
                                                    </div>
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">Net Payable</span>
                                                        <span class="px-3 py-1.5">{{ $item->payment->net_payable }}</span>
                                                    </div>
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">Total Paid</span>
                                                        <span class="px-3 py-1.5">{{ $item->payment->total_paid }}</span>
                                                    </div>
                                                    <div class="inline-flex flex-col items-center gap-4">
                                                        <span class="font-semibold">Due</span>
                                                        <span class="text-sm font-normal px-3 py-1.5 rounded-full {{ $item->payment->due != 0 ? 'text-red-500':'text-gray-500' }} bg-emerald-100/60  dark:open:bg-gray-700 dark:bg-gray-900">
                                                            {{ $item->payment->due }}</h2>
                                                    </div>
                                                </div>
                                            </summary>
                                            <div class="text-sm leading-6 dark:text-gray-400 rounded-md">
                                                <div class="grid grid-cols-6 mt-2 dark:bg-slate-800 p-4 ">
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">ID</span>
                                                    </div>
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">Amount</span>
                                                    </div>
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">Method</span>
                                                    </div>
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">Remark</span>
                                                    </div>
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">Received</span>
                                                    </div>
                                                    <div class="inline-flex">
                                                        <span class="font-semibold">Date</span>
                                                    </div>
                                                </div>

                                                @forelse ($item->payment->paymentLogs as $log)
                                                    <div class="grid grid-cols-6 dark:bg-slate-800 p-4">
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ $loop->iteration }}</span>
                                                        </div>
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ $log->amount }}</span>
                                                        </div>
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ $log->method }}</span>
                                                        </div>
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ $log->remark ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ $log->creator->roleName }}</span>
                                                        </div>
                                                        <div class="inline-flex">
                                                            <span class="font-semibold">{{ date('Y-M-d', strtotime($log->created_at)) }}</span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    No Payment Log Found !
                                                @endforelse

                                                <div>
                                                     @if ($item->payment->due != 0)
                                                        <div class="mt-2">
                                                            <form method="POST" action="{{ route('payments.store') }}">
                                                                @csrf
                                                                <input name="enrolment_id" value="{{ $item->id }}" type="hidden" />
                                                                <input name="payment_id" value="{{ $item->payment->id }}" type="hidden" />
                                                                <div class="dark:bg-slate-800 p-4 rounded-md">
                                       
                                                                        <div class="grid grid-cols-4 gap-4">

                                                                            <div class="mt-4 ">
                                                                                <x-input-label for="course_fee" :value="__('Course Fee')" class="text-left" />
                                                                                <x-text-input id="course_fee" class="block mt-1 w-full dark:!bg-gray-700" type="text" name="course_fee" :value="old('course_fee', $item->payment->course_fee)" readonly />
                                                                                <x-input-error :messages="$errors->get('course_fee')" class="mt-2" />
                                                                            </div>
                                                                            <div class="mt-4 ">
                                                                                <x-input-label for="amount" :value="__('Pay Amount')" class="text-left after:content-['*'] after:ml-0.5 after:text-red-500" />
                                                                                <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required  autofocus autocomplete="amount" placeholder="Amount"/>
                                                                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                                                            </div>
                                                                            <div class="mt-4 ">
                                                                                <x-input-label for="method" :value="__('Course Fee')" class="text-left" />
                                                                                <x-text-input id="method" class="block mt-1 w-full dark:!bg-gray-700" type="text" name="method" :value="old('method', 'Cash')" readonly />
                                                                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
                                                                            </div>
                                                                            <div class="mt-4 ">
                                                                                <x-input-label for="remark" :value="__('Remark')" class="text-left " />
                                                                                <x-text-input id="remark" class="block mt-1 w-full" type="text" name="remark" :value="old('remark')" placeholder="Remark"/>
                                                                                <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                                <div class="flex items-center justify-end mt-4">
                                                                    <x-primary-button class="ms-4">
                                                                        {{ __('Create Payment') }}
                                                                    </x-primary-button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                        </details>
                                    @empty
                                        <p>No Student Found!</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
