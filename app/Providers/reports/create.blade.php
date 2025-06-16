<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold py-5">{{ __('Новая заявка') }}</h2>
    </x-slot>

    <form class="mx-auto max-w-2xl p-4 md:p-5 space-y-4 flex flex-col gap-5" method="POST"
        action="{{ route('reports.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-5">
            {{-- <div>
                <x-input-label for="service_id" :value="__('Выберите услугу')" />
                <select id="service_id" name="service_id" class="block mt-1" required>
                    <option value="" disabled {{ is_null($selectedId) ? 'selected' : '' }}>-- Выберите услугу --</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ $service->id == $selectedId ? 'selected' : '' }}>
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
            </div> --}}

            <div>
                <x-input-label for="title" :value="__('Название')" />
                <x-text-input id="title" class="block mt-1" type="text" name="title" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Описание')" />
                <x-text-input id="description" class="block mt-1" name="description" required />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="path_img" :value="__('Время')" />
                <input type='file' id="path_img" class="block mt-1" name="path_img" required />
                <x-input-error :messages="$errors->get('path_img')" class="mt-2" />
            </div>
            <div>
                <x-primary-button class="ms-3">
                    {{ __('Создать') }}
                </x-primary-button>
            </div>
            <br>
            {{-- @include('layouts.success-message') для сообщения --}}
        </div>
    </form>
</div>
</x-app-layout>
