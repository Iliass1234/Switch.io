let $ = jQuery;
jQuery(document).ready(function ($) {
    $(document).on('focus', '.tcAjaxSearch__field', function () {
        tcAjaxSearch__hideAll();

    })

    $(document).on('keyup', '.tcAjaxSearch__field', debounce(function () {
        let searchField = $(this)
        let value = searchField.val();
        let tcID = searchField.attr('data-tc-id');
        let dataQuery = searchField.data('query');
        tcAjaxSearch__cleanSuggestions(searchField);
        searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__field--value').val('');
        if (value.length > 3) {
            const queryStringToObject = url =>
                [...new URLSearchParams(url.split('?')[1])].reduce(
                    (a, [k, v]) => ((a[k] = v), a),
                    {}
                );
            jQuery.ajax({
                method: 'POST',
                url: document.location.origin + "/wp-admin/admin-ajax.php",
                data: {
                    action: 'tc_ajax_search',
                    search_term: value,
                    query: dataQuery,
                    tcID: tcID,
                    queryStringParams: queryStringToObject(window.location.href),
                },
                beforeSend: function () {
                    tcAjaxSearch__showSingle(searchField)
                    tcAjaxSearch__addSpinner(searchField)
                },
                success: function (response) {

                    tcAjaxSearch__cleanSuggestions(searchField)
                    if (response.success) {
                        response.data.forEach(function (value) {

                            let html = '<span class="tcAjaxSearch__suggestions--item" data-id="' + value.ID + '">' + value.post_title + ' (ID:' + value.ID + ')' +
                                '</span>';
                            searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__suggestions').append(html);
                        })
                    } else {
                        tcAjaxSearch__renderError(searchField, 'Nessun elemento trovato');

                    }

                },
                error: function (errorThrown) {
                    tcAjaxSearch__renderError(searchField, 'Qualcosa è andato storto: riprova!');
                    console.log('errore di sistema', errorThrown)
                }
            });

        }
    }, 300))


    $(document).on('click', '.tcAjaxSearch__suggestions--item', function () {
        let thisItem = $(this);
        let dataPostId = thisItem.data('id');
        if (!thisItem.hasClass('tcAjaxSearch__disabled')) {
            thisItem.closest('.tcAjaxSearch').find('.tcAjaxSearch__field').val(thisItem.text())
            thisItem.closest('.tcAjaxSearch').find('.tcAjaxSearch__field--value').val(dataPostId)
            var event = jQuery.Event( "tc-cmb2-ajax-search-selected" );
            event.tcElement = thisItem;

            $(document).trigger(event);

        }
        tcAjaxSearch__hideAll()
    })
});


//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//FUNCTIONS
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

function tcAjaxSearch__cleanSuggestions(searchField) {
    searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__suggestions').empty();

}

function tcAjaxSearch__addSpinner(searchField) {
    let spinnerHTML = '<div class="tcAjaxSearchSpinner">' +
        '<div class="">' +
        '<div class="bounce1 bounce"></div>' +
        '<div class="bounce2 bounce"></div>' +
        '<div class="bounce3 bounce"></div>' +
        '</div>' +
        '</div>';
    searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__suggestions').append(spinnerHTML);
}

function tcAjaxSearch__renderError(searchField, message) {
    let html = '<span class="tcAjaxSearch__suggestions--item tcAjaxSearch__disabled" > ' + message + '</span>';
    searchField.show();
    searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__suggestions').append(html);
}

function tcAjaxSearch__showSingle(searchField) {
    searchField.closest('.tcAjaxSearch').find('.tcAjaxSearch__suggestions').show();
}

function tcAjaxSearch__hideAll() {
    $('.tcAjaxSearch__suggestions').hide();
}
