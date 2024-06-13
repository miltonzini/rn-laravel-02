@section('title', 'Admin | Listado de Productos')
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
                        <div class="col-md-9">
                            <h1 class="h3 mb-2 text-gray-800">Listado de productos</h1>
                            @if (isset($productsCount) && !isset($search))
                            <p class="mb-4">Total de productos: <span class="info-primary-soft">{{ $productsCount }}</span></p>                           
                            @endif
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-right">Nuevo producto</a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form action="{{ route('admin.products.index') }}" method="post" class="search-form ">
                                    @csrf
                                    <div class="input-group input-group-sm" style="">
                                        <input type="text" name="search" class="form-control float-right" placeholder="Buscar producto" value="{{ isset($search) ? $search : '' }}">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                        @if (isset($search) && isset($productsCount))
                        <p class="mb-4">Resultados: <span class="info-primary-soft">{{ $productsCount }}</span></p>
                        @endif

                        @if (!empty($products) && count($products) > 0 )
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Precio</th>
                                            <th>Etiquetas</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <span class="product-image">
                                                    @if($product->images->isNotEmpty())
                                                        <img class="table-item-thumb" src="{{ asset('public/files/images/products/' . $product->images->first()->image) }}" alt="{{ $product->title }}">
                                                    @else
                                                        <img class="table-item-thumb" src="{{ asset('public/files/images/products/product-image-placeholder.jpg') }}" alt="producto sin imagen">
                                                    @endif
                                                </span>
                                                {{ $product->title }}
                                            </td>
                                            <td>{!! $product->category_id ? $product->category->title : '<span class="text-muted">Sin categoría</span>' !!}</td>
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
                                                    <span class="price-with-discount text-success"><strong>${{ numberFormat($priceWithDiscount)}}</strong></span>
                                                    <del><span class="original-price {{ $showDiscount ? 'text-muted small' : '' }}">${{ numberFormat($price)}}</span></del>
                                                    <span class="disclaimer text-muted">(descuento del {{ $discount }}%) </span>
                                                @else
                                                    <span class="original-price {{ $showDiscount ? 'text-muted small' : '' }}">${{ numberFormat($price)}}</span>
                                                @endif
                                            </td>
                                            <td class="tags">
                                                @if ($product->tags and count($product->tags) > 0)
                                                    <div class="tags-wrapper">
                                                        @foreach ($product->tags as $tag )
                                                            <div class="product-tag product-tag-sm">{{ $tag->tag }}</div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-muted small">sin etiquetas</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#product-preview-modal-{{$product->id}}"><i class="fa fa-eye"></i></a>

                                                |
                                                
                                                <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"><i class="fa fa-edit"></i></a>

                                                |

                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#product-delete-modal-{{$product->id}}"><i class="fa fa-trash"></i></a>
                                                
                                                
                                                <div class="modal fade product-preview-modal" id="product-preview-modal-{{$product->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header"><strong>{{$product->title}}</strong></div>
                                                            <div class="modal-body">
                                                                @if($product->images->isNotEmpty())
                                                                    <div class="images-wrapper">
                                                                        @foreach($product->images as $image)
                                                                            <div class="image-item">
                                                                                <img class="thumb" src="{{ asset('public/files/images/products/' . $image->image) }}" alt="{{ $product->title }}">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <p class="text-muted">No hay imágenes disponibles.</p>
                                                                @endif
                                                                <div class="product-description">
                                                                    <p><strong>ID:</strong> {{$product->id}}</p>
                                                                    <p><strong>Descripción:</strong> {!! $product->description ? $product->description : '<span class="text-muted">No disponible</span>' !!}</p>
                                                                    <p><strong>Categoría:</strong> {!! $product->category_id ? $product->category->title : '<span class="text-muted">No disponible</span>' !!}</p>
                                                                    
                                                                    @if($showDiscount)       
                                                                    <p><strong>Precio original:</strong> ${{ numberFormat($product->price)}}</p>
                                                                    <p><strong>Descuento:</strong> {{ $product->discount }} %</p>
                                                                    <p><strong>Precio con descuento:</strong> ${{ numberFormat($priceWithDiscount)}}</p>
                                                                    @else
                                                                    <p><strong>Precio:</strong> ${{ numberFormat($product->price) }}</p>
                                                                    @endif

                                                                    <h5>Etiquetas</h5>
                                                                    @if ($product->tags and count($product->tags) > 0)
                                                                        <div class="tags-wrapper">
                                                                            @foreach ($product->tags as $tag )
                                                                                <div class="product-tag product-tag-sm">{{ $tag->tag }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <p class="text-muted small">sin etiquetas</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <a class="btn btn-primary" href="{{ route('admin.products.edit', ['id' => $product->id]) }}">Editar</a>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                                
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