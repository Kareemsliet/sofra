<div>
    <div class="amount d-flex flex-column justify-content-start align-items-start">
        <div class="d-flex gap-2 mt-3">
            <p>الكمية:</p>
            <div class="counter">
                <input wire:change='changeQuantity'  type="number" min="1" max="10" wire:model.live='quantity' id="">
            </div>
        </div>
        @error('quantity')
        <p class="text-danger" style="font-size:14px;">{{$message}}</p>
        @else
        @enderror
    </div>
</div>
