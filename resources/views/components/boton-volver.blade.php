@props(['ruta' => null])

<a href="{{ $ruta ?? route('dashboard') }}"
   class="px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
    ← Volver
</a>
