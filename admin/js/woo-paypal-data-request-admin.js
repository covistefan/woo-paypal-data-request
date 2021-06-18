var jQ = jQuery.noConflict();

function initTablist() {
    var tlo = false;
    jQ('.tabcontent').hide();
    jQ('.tablist li').each(function(){
        if (jQ(this).hasClass('active')) { 
            tlo = true;
            var t = jQ(this).find('a').attr('href');
            jQ('#tablist-data').val(t);
            jQ(t).show();
        }
    });
    if (tlo===false) {
        jQ('.tablist li').first().addClass('active');
        jQ('.tabcontent').hide();
        var t = jQ('.tablist li').first().find('a').attr('href');
        jQ('#tablist-data').val(t);
        jQ(t).show();
    }
}

jQ('document').ready(function(){
    
    initTablist();
    
    jQ('.tablist li a').click(function(e) {
        e.preventDefault();
        jQ('.tablist li').removeClass('active');
        jQ(this).parent('li').addClass('active');
        var t = jQ(this).attr('href');
        jQ('.tabcontent').hide();
        jQ('#tablist-data').val(t);
        jQ(t).show();
    });
    
    jQ('#wpdg_status').on('change', function (e) {
        if (jQ(this).prop('checked')) {
            jQ('#wpdg_dev').prop('disabled', false);
            jQ('#wpdg_disableaddress').prop('disabled', false);
            jQ('.tablist li.status').show();
        }
        else {
            jQ('#wpdg_dev').prop('checked', false);
            jQ('#wpdg_dev').prop('disabled', 'disabled');
            jQ('#wpdg_disableaddress').prop('checked', false);
            jQ('#wpdg_disableaddress').prop('disabled', 'disabled');
            jQ('.tablist li.status').hide();
        }
    });
    
    jQ('#wpdg_request_always').on('change', function (e) {
        if (jQ(this).prop('checked')) {
            jQ('#wpdg_order_details').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
            jQ('#wpdg_order_overview').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
            jQ('#wpdg_admin_dashboard').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
        } else {
            jQ('#wpdg_order_details').prop('readonly', false).prop('disabled', false).prop('checked', false);
            jQ('#wpdg_order_overview').prop('readonly', false).prop('disabled', false).prop('checked', false);
            jQ('#wpdg_admin_dashboard').prop('readonly', false).prop('disabled', false).prop('checked', false);
        }
    });
    
    jQ('#wpdg_admin_dashboard').on('change', function (e) {
        if (jQ(this).prop('checked')) {
            jQ('#wpdg_order_details').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
            jQ('#wpdg_order_overview').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
        } else {
            jQ('#wpdg_order_details').prop('readonly', false).prop('disabled', false).prop('checked', false);
            jQ('#wpdg_order_overview').prop('readonly', false).prop('disabled', false).prop('checked', false);
        }
    });
    
    jQ('#wpdg_order_overview').on('change', function (e) {
        if (jQ(this).prop('checked')) {
            jQ('#wpdg_order_details').prop('readonly', 'readonly').prop('disabled', 'disabled').prop('checked', true);
        } else {
            jQ('#wpdg_order_details').prop('readonly', false).prop('disabled', false).prop('checked', false);
        }
    });

});

