<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top']) }}>
    {{ $slot }}
</button>
