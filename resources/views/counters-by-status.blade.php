<div class="mb-3">
    <div class="row mb-2 g-3 g-mb-4">
        @foreach($data as $key => $value)
            <div class="col">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <p
                        class="h5 fw-light mt-auto"
                        style="color: {{ $value['color'] }}"
                    >
                        {{ $key }}: {{ $value['count'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
