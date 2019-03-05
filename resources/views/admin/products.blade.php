@extends('admin_layouts.app')

@section('body')

    <div class="container" id="products">

        <div class="row">
            <div class="offset-md-1 col-md-11 ">
                <div class=" bd bdrs-3 p-20 mB-20 bg-primary ">
                    <h3 class="c-white mB-20" id="message">Products Table</h3>
                    <table id="dataTable" class="table table-bordered" style="background-color:#6EB7FF;color:black" cellspacing="0" width="100%">

                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Asin</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="btn-group mr-2" role="group" aria-label="First group" id="paginate"> </div>
    </div>
    </div>
    @include('admin_layouts.delete_modal')
@endsection
