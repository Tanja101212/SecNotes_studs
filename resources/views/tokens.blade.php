<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tokens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-3">


                    <form method="post" action="/tokens">
                        @csrf

                        <div>
                            <h1>{{__('Add a token')}}</h1>
                        </div>

                        @if (session()->has('success'))

                            <div>
                                <p class="font-semibold text-emerald-300">
                                    {{session('success')}}
                                </p>
                                <p class="text-2xl font-semibold">
                                    {{ __('Your token is: :token', ['token'=>session('token')])}}
                                </p>
                            </div>
                        @endif>


                        <div class="mt-4">
                            @error('title')
                            <p class="font-semibold text-red-600">
                                {{$message}}
                            </p>
                            @enderror
                            <label for="title">{{__('Title')}}</label>
                            <input class="w-full" value="{{old('title')}}" name="title" id="title" type="text">
                        </div>

                        <div class="mt-4">
                            <input type="checkbox" id="checkbox-list" name="abilities[]" value="note:list"
                            @if(is_array(old('abilities')) && in_array('note:list', old('abilities'))) checked="checked" @endif />
                            <label for="checkbox-list">{{__('List notes')}}</label>
                        </div>

                        <div class="mt-4">
                            <input type="checkbox" id="checkbox-create" name="abilities[]" value="note:create"
                            @if(is_array(old('abilities')) && in_array('note:create', old('abilities'))) checked="checked" @endif />
                            <label for="checkbox-create">{{__('Create notes')}}</label>
                        </div>

                        <div class="mt-4">
                            <input type="checkbox" id="checkbox-edit" name="abilities[]" value="note:edit"
                            @if(is_array(old('abilities')) && in_array('note:edit', old('abilities'))) checked="checked" @endif />
                            <label for="checkbox-edit">{{__('Edit notes')}}</label>
                        </div>

                        <div class="mt-4">
                            <input type="checkbox" id="checkbox-delete" name="abilities[]" value="note:delete"
                            @if(is_array(old('abilities')) && in_array('note:delete', old('abilities'))) checked="checked" @endif />
                            <label for="checkbox-delete">{{__('Delete notes')}}</label>
                        </div>


                        <div class="mt-4">
                            <x-primary-button>
                                {{__('Create token')}}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 space-y-3">

                @foreach(auth()->user()->tokens as $token)

                 <div>
                     {{$token->name}}
                 </div>
                @endforeach


            </div>
        </div>
    </div>
    </div>
</x-app-layout>
