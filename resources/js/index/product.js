
var params = {};
var paginate = '';
var is_home = $('#home_page').length;
var is_category = $('#category_page').length;
var sliderRange;
var price_change = 0;
var price_values;
var price_values_default;
function productsFilter() {
            $('#product-and-pagination').hide();
            $('#loader').show();
    axios.post('/search' + paginate, params ).then(function (response) {
        if (response.data.html) {
            $('#products_list').html(response.data.html);
            $('#paginate').html(response.data.paginate);
            if(!is_home) {
                $('#main').hide('normal');
            }
            $('#product-and-pagination').show();
            $('#loader').hide();

            $('a.page-link').attr('href', "javascript:void(0);").click(function () {
                var page = $(this).html();
                if(page=='‹' || page=='›') {
                    paginate = '?page=' + $(this).attr('name');
                } else if(page!='...') {
                    paginate = '?page=' + page;
                }
                productsFilter();
            });
            setTimeout(function() {
              //  if(console.error) console.clear();
            },1100);
            sliceDescriptions();
        } else {
            $('#loader').hide('slow');
            $('#product-and-pagination').show('slow');
            $('#products_list').html('<h1 class="mr-5">Sorry no more products to show</h1>').show('normal');
            $('#paginate').hide()
        }
    }).catch(function (e) {
       console.log(e);
    });
}


$(function () {

    if($('#slider').length){
         price_values = [0,Number($('span#price_2').html())];
         price_values_default = price_values;
    }

    if($('#add-category').length) {
        $('.js-example-basic-single').select2();
    }
    if($('#single').length) {
        sliceDescriptions();

        $('#description').html($('#description').html().replace('See more product details','').replace('More',''));
        $('#promo_code_button').click(()=>{
            var copyText = $("#promo_code");
            copyText.select();
            document.execCommand("copy");

        });

        setTimeout(function() {
            if(console.error) console.clear();
        },1100);
    }

    if (is_home) {
        setFilter('newest');
    } else if (is_category) {
        params['category_id'] = Number($('.product--list').attr('id'));
        productsFilter();
    } else {
        sliceDescriptions();
    }

    $('#random, #popular, #newest').click(function() {
        setFilter($(this).data('filter'));
    });

    $('#filter-dropdown').on('change', function() {
        const filter = $(this).val();
        paginate = '';
        if(!filter.length) {
            delete params.filter;
            price_values = price_values_default;
            sliderRange.slider( "option","values",[0,Number(price_values_default[1])]);
            setPriceValues(0,price_values_default[1]);
            delete params.range;
            productsFilter();
        } else {
            price_values = price_values_default;
            sliderRange.slider( "option","values",[0,Number(price_values_default[1])]);
            setPriceValues(0,price_values_default[1]);
            delete params.range;
            setFilter(filter);
        }
    });
    

    $('#search-button').on('keyup paste input touchend', function (e) {
        if (!e.which  || ( e.which >= 48 && e.which <= 90) || e.which == 200 || e.which == 46 || e.which == 8 || e.which == 13) {
            const keyword = $(this).val();
            const is_main_layout = $('#main').length;
            paginate = '';
            if (keyword.length > 2 && keyword!=params['search']) {
                params['search'] = keyword;
                productsFilter();
            } else if(!keyword.length) {
                delete params.search;
                if(!is_home && is_main_layout) {
                    $('#product-and-pagination').hide('normal');
                    $('#main').show('normal');
                } else {
                    productsFilter();
                }
            }
        }
    });


    $('.gifts_under').click(function () {
        active('gifts_under');
        var price = Number($(this).find("span").html());
        if(is_category || is_home) {
            sliderRange.slider("values",[0,price]);
            setPriceValues(0,price);
        } else { setRange([0,price])};
    });

    $('#price_range').click(function () {
        active('price_range');
        $('#slider').slideToggle();
    });

    if ($('#range_slider').length) {
        sliderRange = $('#range_slider').slider({
            range: true,
            min: 0,
            max: Number(price_values_default[1]),
            values: [0,price_values_default[1]],
            step: 5,
            slide: function(e,ui) {
                var values = ui.values;
                setPriceValues(values[0],values[1]);
            },
            change: function(e,ui) {
                const values = ui.values;
                if((!_.isEqual(values, [price_values[0],price_values[0]])) && (!_.isEqual(values, [price_values[1],price_values[1]])) ){
                    if(!_.isEqual(values, price_values)) {
                         price_values = values;
                         price_change = 1;
                    } else {
                         price_change = 0;
                    }
                    if(price_change) {
                        setRange(values);
                    }
                }
            }
        });
            if (is_home) {
                $('#slider').hide();
            }
    }
});


function active(element) {
    $('.filter-list > a').removeClass('active');
    (element == 'gifts_under')? $('.gifts_under').addClass('active'):$(`#${element}`).addClass('active');
}

function resetFilters() {
    $('#search-button').val('');
    if(sliderRange) {
        price_values = price_values_default;
        sliderRange.slider( "option","values",[0,Number(price_values_default[1])]);
        setPriceValues(0,price_values_default[1]);
    }
    paginate = '';
    params = {};
}

function setFilter(filter) {
    if (is_home ) {
        resetFilters();
    }
    active(filter);
    params.filter = filter;
    productsFilter();
}

function setRange(range) {
    paginate='';
    if (is_home) {
        delete params.filter;
    }
    params.range = range.join(':');
    productsFilter();
}

function sliceDescriptions() {
        $("p.product--desc").html(function(index,value) {
            return value.trim().slice(0,105)+'...';
        });
}

function setPriceValues(value_1,value_2) {
    $('span#price_1').html(value_1);
    $('span#price_2').html(value_2);
}


