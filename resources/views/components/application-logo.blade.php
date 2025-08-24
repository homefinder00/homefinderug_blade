{{-- RentHub Logo - Properly styled for different contexts --}}
<img src="{{ asset('images/image.png') }}" 
     alt="RentHub" 
     {{ $attributes->merge(['class' => 'block h-auto max-h-12 w-auto object-contain']) }}>
