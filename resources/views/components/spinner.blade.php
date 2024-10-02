
@php
    
@endphp
<div id="spinner-overlay">
@switch($name)
    @case('spinner_one')
        <div id="spinner_one" class="fulfilling-bouncing-circle-spinner">
            <div class="circle"></div>
            <div class="orbit"></div>
        </div>
        @break
    @case('spinner_two')
        <div id="spinner_two"></div>
    @break
    @default
        <div id="spinner_two"></div>
    @endswitch
        
</div>
