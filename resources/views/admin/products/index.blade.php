@section('title', 'Admin / Products / Index')
<x-adminLayout>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.aside')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.admin.nav')

                <div class="container-fluid">
                    <div class="row">
                        

                        <div class="col-lg-9">
                            <h1 class="h3 mb-2 text-gray-800">Listado de productos</h1>
                            @if (isset($productsCount))                 
                            <p class="mb-4">Total registrados: {{ $productsCount }}</p>                           
                            @endif
                        </div>

                        <div class="col-lg-3">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-right">Nuevo producto</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                        @if (!empty($products) && count($products) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->title }}</td>
                                            <td>{!! $product->category_id ? $product->category->title : '<span class="text-muted">sin categoría</span>' !!}</td>
                                            @php
                                                $price = $product->price;
                                                $discount = $product->discount;
                                                if ($discount > 0) {
                                                    $priceWithDiscount = ($price - ($price * $discount / 100 ));
                                                    $showDiscount = true;
                                                } else {
                                                    $showDiscount = false;
                                                }
                                                
                                            @endphp
                                            <td>
                                                @if ($showDiscount)                                                    
                                                    <del><span class="original-price {{ $showDiscount ? 'text-muted small' : '' }}">${{ number_format($price, 2)}}</span></del>
                                                    <span class="price-with-discount text-success"><strong>${{ $priceWithDiscount}}</strong></span>
                                                    <span class="disclaimer text-muted">(descuento del {{ $discount }}%) </span>
                                                @else
                                                    <span class="original-price {{ $showDiscount ? 'text-muted small' : '' }}">${{ number_format($price, 2)}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"><i class="fa fa-edit"></i></a>

                                                |

                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#product-delete-modal-{{$product->id}}"><i class="fa fa-trash"></i></a>

                                                <div class="modal fade" id="product-delete-modal-{{$product->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">¿Desea eliminar el producto?</div>
                                                            <div class="modal-body">
                                                                <p>¿Eliminar <strong>{{ $product->title }}</strong>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger delete-product-button" data-product-id="{{ $product->id }}">Eliminar</button>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination p-4">
                            {{ $products->links() }}
                            <div>
                        @else
                            <div class="px-4 py-4">
                                <h4>No se encontraron productos</h4>
                            </div>
                        @endif
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/vendor/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('resources/vendor/sb-admin-2/js/demo/datatables-demo.js') }}"></script>
@if (isset($scripts) && !empty($scripts))
@foreach ($scripts as $script)
    <script src="{{ asset('public/js/functions/' . $script) }}"></script>
@endforeach
@endif
@endpush
</x-adminLayout>