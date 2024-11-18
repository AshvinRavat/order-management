@extends('layout.main')

@section('title')
    Order-Create
@endsection

@section('content')
    <div class="container col-6 border p-4 mt-5">
        <h3 class="text-center text-bold">Create Order</h3>
        <form action="{{ route('order.store') }}" method="POST" class="repeater">
            @csrf
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer
                    <span class="text-danger">*</span>
                </label>
                <select id="customer_id" name="customer_id" class="form-control">
                    <option value="">Select Select </option>
                    @foreach ($customers as $id => $customer)
                        <option value="{{ $id }}">
                            {{ $customer }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3" data-repeater-list="product-items">
                <div class="row" data-repeater-item>
                    @if(session()->has('errors'))
                        @foreach (old('product-items', []) as $index => $product)
                        <div class="col-2">
                        <label for="name" class="form-label">Product
                            <span class="text-danger">*</span>
                        </label>
                         <input type="text" class="form-control name" name="product-items[{{ $index }}][name]" value="{{ old('product-items.' . $index . '.name') }}">
                        @error('product-items.' . $index . '.name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-2">
                        <label for="price" class="form-label">price
                            <span class="text-danger">*</span>
                        </label>
                         <input type="text" class="form-control price" name="product-items[{{ $index }}][price]" 
                         value="{{ old('product-items.' . $index . '.price') }}">
                        @error('product-items.' . $index . '.price')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>                                
                         <div class="col-2">
                        <label for="quantity" class="form-label">Quantity
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control quantity" name="product-items[{{ $index }}][quantity]" value="{{ old('product-items.' . $index . '.quantity') }}">
                        @error('product-items.' . $index . '.quantity')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                         <div class="col-2">
                        <label for="total" class="form-label">Total
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" disabled class="form-control total" id="total" name="total"
                        value="0.00">
                    </div>
                        @endforeach
                    @else
                    <div class="col-2">
                        <label for="name" class="form-label">Product
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name" >   
                    </div>
                    <div class="col-2">
                        <label for="price" class="form-label">price
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control price" id="price" name="price" >   
                    </div>
                    <div class="col-2">
                        <label for="quantity" class="form-label">Quantity
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control quantity" id="quantity" name="quantity">   
                    </div>
                    <div class="col-2">
                        <label for="total" class="form-label">Total
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"  class="form-control total" id="total" name="total"
                        value="0.00">
                    </div>
                    <div class="col-2">
                        <input data-repeater-delete type="button" value="Delete"/>
                    </div>
                </div>
                @endif 
            </div>
              <input data-repeater-create type="button" value="Add"/>
              <br>
              <label>
                Grand Total: 
                <span class="grand-total">
                    0.00
                </span>
              </label>
              <br>
            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

    @push('script')
        <script>
            $('.repeater').repeater({
                  isFirstItemUndeletable: true,
            });
             setInterval(function () {
             let grandTotal = 0;

        $('.total').each(function() {
            const totalValue = parseFloat($(this).val()) || 0;  
            grandTotal += totalValue;  
        });

        $('.grand-total').html(grandTotal);
        }, 1000);
    
        $(document).on('input', '.quantity, .price', function () {
            let quantity = 10;
            let price = '';
            if ($(this).attr('id') == 'quantity')
            {
                if (($(this).val() < 0 || isNaN($(this).val())))
                {
                    $(this).val('') ;
                }

                price = $(this).closest('.row').find('.price').val();
                quantity = $(this).val();
            }
            else if ($(this).attr('id') == 'price') {
                if (($(this).val() < 0 || isNaN($(this).val())))
                {
                    $(this).val('') ;
                }

                quantity = $(this).closest('.row').find('.quantity').val();
                price = $(this).val();
            }   
            
            if (quantity > 0 && price > 0)
            {
                $(this).closest('.row').find('.total').val(price * quantity);  // Clear the total field if either price or quantity is invalid
            }
            
            else {
                $(this).closest('.row').find('.total').val(0.00);
            }

        let grandTotal = 0;

        $('.total').each(function() {
            const totalValue = parseFloat($(this).val()) || 0;  
            grandTotal += totalValue;  
        });

        $('.grand-total').html(grandTotal);
    });
        </script>
    @endpush
@endsection