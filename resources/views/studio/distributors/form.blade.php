@php($editing = isset($distributor))
<form method="POST" action="{{ $editing ? route('studio.distributors.update', $distributor) : route('studio.distributors.store') }}" class="studio-form" enctype="multipart/form-data">
    @csrf
    @if ($editing) @method('PUT') @endif
    <section class="studio-form-panel">
        <p class="studio-form-panel-title">01 / {{ __('hellios.studio.distributors') }}</p>
        <label class="block"><span class="form-label">{{ __('hellios.studio.distributor_name') }}</span><input name="name" value="{{ old('name', $distributor->name ?? '') }}" class="form-input" placeholder="{{ __('hellios.studio.distributor_name_placeholder') }}" required>@error('name')<span class="form-error">{{ $message }}</span>@enderror</label>
        <label class="mt-6 block"><span class="form-label">{{ __('hellios.studio.country') }}</span><input name="country" value="{{ old('country', $distributor->country ?? '') }}" class="form-input" placeholder="{{ __('hellios.studio.country_placeholder') }}" required>@error('country')<span class="form-error">{{ $message }}</span>@enderror</label>
    </section>
    <section class="studio-form-panel">
        <p class="studio-form-panel-title">02 / {{ __('hellios.studio.logo') }}</p>
        @if ($editing && $distributor->logo_path)<div class="studio-current-logo"><span>{{ __('hellios.studio.current_logo') }}</span><img src="{{ asset('storage/'.$distributor->logo_path) }}" alt="{{ $distributor->name }}"></div>@endif
        <label class="block"><span class="form-label">{{ __('hellios.studio.logo') }}</span><input type="file" name="logo" accept="image/png,image/jpeg,image/webp" class="form-input file:mr-4 file:border-0 file:bg-hellios-pink file:px-3 file:py-2 file:text-xs file:font-bold file:text-white">@error('logo')<span class="form-error">{{ $message }}</span>@enderror</label>
        <p class="studio-field-help">{{ __('hellios.studio.logo_help') }}</p>
    </section>
    <div class="studio-form-actions"><button class="studio-button">{{ $editing ? __('hellios.studio.save') : __('hellios.studio.add_distributor') }} <span aria-hidden="true">↗</span></button><a href="{{ route('studio.distributors.index') }}" class="studio-button-secondary">{{ __('hellios.studio.cancel') }}</a></div>
</form>
