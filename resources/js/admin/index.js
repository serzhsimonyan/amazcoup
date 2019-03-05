
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    setTimeout(() => {
        loader.classList.add('fadeOut');
    }, 300);

     if($('.js-example-basic-single').length){
         $('.js-example-basic-single').select2();
     }
    
    if($('.js-example-basic-multiple').length) {
        $('.js-example-basic-multiple').select2();
    }
    
    
    ////////////////////////////////////////////
    if($('#products').length) {
       var  productsTable = $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_ products",
                "info": "Showing page _PAGE_ of _PAGES_ of _TOTAL_ products",
                "infoEmpty": "No products available",
            },
            "serverSide": true,
            "autoWidth": true,
            "bSort" : false,
            "ajax": { url: "/admin/products/table" },

           "columnDefs": [
               {
                   "targets": 0,
                   'data':'title',
                   "render": function ( data ) {
                       return data;
                   }
               },
               {
                   "targets": 1,
                   'data':'asin',
                   "render": function ( data) {
                       return data;
                   }
               },
               {
                   "targets": 2,
                   "render": function ( data, type, row) {
                       if(row['price']) {
                           return "$"+row['price'];
                       } else{
                           return "null";
                       }
                   }
               },
               {
                   "targets": 3,
                   "render": function ( data, type, row) {
                       if(row['discount_price']) {
                           return "$"+row['discount_price'];
                       } else{
                           return "null";
                       }
                   }
               },
               {
                   "targets": 4,
                   "render": function ( data, type, row) {
                      return "<a  href="+'/admin/edit/'+row['asin']+" style='font-size:20px'><i class='far fa-x fa-edit c-green-500'></i></a>";
                   }
               },
               {
                   "targets": 5,
                   "render": function ( data, type, row) {
                       return "<button type='button'  data-toggle='modal'  data-target='#deleteModal' data-content='"+row['id']+"' style='font-size:10px' class='btn btn-outline-danger fa-x delete'><i class='far fa-trash-alt'></i></button>";
                   }
               },

           ],
            "drawCallback": function() {
                $('.delete').unbind();$('#delete').unbind();
                $('.delete').click(function() {
                    $('#deleteModal .modal-body p ').html('Do you wont to delete '+'"'+$(this).parent().siblings('td:first').text()+'"'+' product');
                    $('#delete').attr('data-content',$(this).attr('data-content'));
                });

                $('#delete').click(function () {
                    axios.post('/admin/delete',{'id':$(this).attr('data-content')}).then(function (response) {
                        if(response.data.complete) {
                            toastr.success(response.data.complete);
                            productsTable.ajax.reload(null,false);
                        }
                    })
                        .catch(function(err) {
                            var error = err.response.data;
                            if(error.slug_error)  {
                                toastr.error(error.slug_error);
                            } else if(error.error_404){
                                toastr.error(error.error_404);
                            }

                        })
                });
                $('td').attr('align','center').css({'font-size':'14px'});
                $('.dataTables_info').css('color','white');
                $('a.paginate_button ').css({'background-color':'#064ceb','color':'red'});
            }
        });
    }

    ////////////////////////////////////////////////
    if($('#edit-categories').length) {
        $('#categories-table').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_ categories",
                "info": "Showing page _PAGE_ of _PAGES_ of _TOTAL_ categories",
                "infoEmpty": "No categories available",
            },
            "aaSorting": [],
            "bSort" : false,
            "serverSide": true,
            "autoWidth": true,
            "ajax": { url: "/admin/edit/categories/table" },

            "columns": [
                { "data": "name"},
                { "targets": 1, "render": function (data, type, row) {
                    return "<a role='button' href="+'/admin/edit/category/'+row['slug']+'/'+row['id']+" style='font-size:22px'><i class='c-green-500 fas fa-pen-square'></i></a>";
                }},
                { "data": "parent_id", "render": function (parent_id) {
                    if(parent_id) {
                        return parent_id;
                    } else {
                        return "parent" ;
                    }
                }},

            ],
            "fnDrawCallback": function() {
                $('td').attr('align','center').css({'font-size':'14px'});
                $('.dataTables_info').css('color','white');
                $('a.paginate_button ').css({'background-color':'#064ceb','color':'red'});
            }
        });

    }

    if($('#completeMessage').length && !$('#completeMessage').is(':hidden')) {
        setTimeout(function() {
            $('#completeMessage').hide();
        }, 6000);
    }

    if ($('#errorMessage').length && !$('#errorMessage').is(':hidden')) {
        setTimeout(function() {
            $('#errorMessage').hide();
        }, 6000);
    }
});