@extends('admin_layouts.app')

@section('body')

<div class="container" id="edit-categories">
            <div class="row">
                <div class="offset-md-2 col-md-8 ">
                    @include('admin_layouts.slug_error')
                    @include('admin_layouts.complete')
                    <div class=" bg-primary bd bdrs-3 p-20 mB-20 ">
                        <h1 class="c-white">Edit categories</h1>
                    <table class="table table-bordered" id="categories-table"  style="background-color:#6EB7FF;color:black" cellspacing="0" width="100%">
                        <thead >
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Parent</th>
                            </tr>
                        </thead>
                    </table>
                  </div>
               </div>
             </div>
</div>

@endsection