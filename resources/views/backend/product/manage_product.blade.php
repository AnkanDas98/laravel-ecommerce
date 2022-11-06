<x-admin.layouts.master :breadcrumb='true'>
    <x-slot name='pageTitle'>Manage Products</x-slot>
    <x-slot name='breadcrumbSection'>
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Manage Products</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Tables</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Product List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name English</th>
                                    <th>Product Name Bangla</th>
                                    <th>Product Price</th>
                                    <th>Product Discount</th>
                                    <th>Product Qty</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $product->product_thumbnail) }}"
                                                title="{{ $product->product_name_eng }}"
                                                alt="{{ $product->product_name_eng }}"
                                                style="height: 50px; width: 60px;"></td>
                                        <td>{{ $product->product_name_en }}</td>
                                        <td>{{ $product->product_name_bn }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>
                                            @if ($product->discount_price)
                                                {{ round($product->selling_price - $product->selling_price * ($product->discount_price / 100)) }}
                                                ({{ $product->discount_price }}%)
                                            @else
                                                <span class="text-info text-w-bold">No Discount</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->product_qty }}</td>
                                        <td>
                                            @if ($product->status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="d-flex" style="width: 30%">
                                            <a href="{{ route('edit.product', $product->id) }}"
                                                class="btn btn-info mr-2" title="Edit Data"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('delete.product', $product->id) }}"
                                                method="POST" class="d-inline-block mr-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger deleteBtn"
                                                    title="Delete Data"><i class="fa fa-trash"></i></button>
                                            </form>

                                            <form action="{{ route('update.product.status') }}" method="POST"
                                                class="d-inline-block mr-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                    class="btn {{ $product->status ? 'btn-danger' : 'btn-success' }}"
                                                    title="{{ $product->status ? 'Inactive Now' : 'Actice Now' }}"><i
                                                        class="fa {{ $product->status ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name English</th>
                                    <th>Product Name Bangla</th>
                                    <th>Product Price</th>
                                    <th>Product Discount</th>
                                    <th>Product Qty</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </div>

</x-admin.layouts.master>
